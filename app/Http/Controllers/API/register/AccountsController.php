<?php

namespace App\Http\Controllers\API\register;

use Illuminate\Support\Facades\Validator;
use App\Models\Account;
use App\Models\Invoice;
use App\Models\Subscription;
use App\Http\Controllers\Controller;
use App\Jobs\AccontCreateJob;
use App\Jobs\DeleteAccountJob;
use App\Jobs\NotifySubscriptionEndJob;
use App\Models\Coupon;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::orderBy('id', 'desc')->paginate(10);
        return view('admin.Accounts.accountslist', compact('accounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        $account = Account::find($id);
        $subscription = Subscription::all();
        return view('admin.Accounts.editaccounts', compact('account', 'subscription'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the account
        $account = Account::find($id);
        if (!$account) {
            return redirect()->route('account.index')->with('error', 'Account not found.');
        }

        // Validate the request
        $validated = Validator::make($request->all(), [
            'role' => 'required|in:buyer,seller',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:accounts,email,' . $id,
            'password' => 'nullable|min:8',
            'subscription_id' => 'required',
            'phone_number' => 'nullable|string',
            'country' => 'required|string',
        ]);

        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated->errors());
        }

        // Update account attributes
        $account->role = $request->role;
        $account->name = $request->name;
        $account->surname = $request->surname;
        $account->email = $request->email;

        if ($request->has('password') && $request->password) {
            $account->password = bcrypt($request->password);
        }

        $account->subscription_id = $request->subscription_id;
        $account->country_code = $request->country_code;
        $account->phone_number = $request->phone_number;
        $account->country = $request->country;

        // Save the updated account
        $account->save();

        return redirect()->route('account.index')->with('success', 'Account updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $account = Account::find($id);
        $account->delete($id);
        return redirect()->route('account.index')->with('success', 'Account deleted successfully');
    }



    public function storeAccounts(Request $request)
{
    $validated = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'email' => 'required|email|unique:accounts',
        'password' => 'required|min:8',
        'country_code' => 'nullable',
        'phone_number' => 'nullable|string',
        'country' => 'required|string',
        'role' => 'required|in:buyer,seller',
        'subscription_id' => 'required',
        'coupon_code' => 'nullable',
    ]);

    if ($validated->fails()) {
        return response()->json([
            'status' => 'false',
            'message' => 'Validation failed',
            'error' => $validated->errors(),
        ], 400);
    }

    $coupon_code = $request->coupon_code;
    $coupon_detail = null;

    if ($coupon_code) {
        $coupon_detail = Coupon::where('code', $coupon_code)->first();

        if (!$coupon_detail) {
            return response()->json([
                'status' => 'false',
                'message' => 'The Coupon is Invalid',
            ], 400);
        }

        if ($coupon_detail->status !== 'active') {
            return response()->json([
                'status' => 'false',
                'message' => 'The Coupon is Blocked',
            ], 400);
        }

        if ($coupon_detail->expiry_date <= now()) {
            return response()->json([
                'status' => 'false',
                'message' => 'The Coupon is Expired',
            ], 400);
        }
    }

    $subscription_detail = Subscription::where('id', $request->subscription_id)->first();

    if (!$subscription_detail) {
        return response()->json([
            'status' => 'false',
            'message' => 'The Subscription is Invalid',
        ], 400);
    }

    $plan_name = $subscription_detail->plan_name;
    $subscription_price = $subscription_detail->Discount_Price;

    // Handle cases where no coupon is provided
    $coupon_discount = $coupon_detail->discount ?? 0;
    $finalprice = $subscription_price - $coupon_discount;

    $account = Account::create([
        'name' => $request->name,
        'surname' => $request->surname,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'country_code' => $request->country_code,
        'phone_number' => $request->phone_number,
        'country' => $request->country,
        'role' => $request->role,
        'subscription_id' => $request->subscription_id,
        'coupon_id' => $coupon_detail->id ?? null,
    ]);

    $accountId = $account->id;
    $invoice = Invoice::create([
        'account_id' => $accountId,
        'company' => $request->company_name,
        'eu_tax_number' => $request->tax_number,
        'street_unit' => $request->street_address,
        'postal_code' => $request->postal_code,
        'city' => $request->city,
    ]);

    if ($account) {
        dispatch(new AccontCreateJob($account->email));

        $subscriptionEndDate = now()->addMonths(12);
        $notificationDate = $subscriptionEndDate->copy()->subDays(10);

        // Schedule a notification email 10 days before subscription end
        dispatch(new NotifySubscriptionEndJob(
            $account->email,
            $account->name,
            $subscriptionEndDate->format('Y-m-d')
        ))->delay($notificationDate);

        // Schedule account deletion after subscription ends
        dispatch(new DeleteAccountJob($account->id))
            ->delay($subscriptionEndDate);
    }

    return response()->json([
        'status' => true,
        'message' => 'Account created successfully',
        'account' => $account,
        'subscription_name' => $plan_name,
        'subscription_price' => $subscription_price,
        'coupon_price' => $coupon_discount,
        'discount_price' => $finalprice,
        'Invoice' => $invoice,
    ], 201);
}


    public function storeInvoice(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'account_id' => 'required|exists:accounts,id',
            'company' => 'required|string',
            'eu_tax_number' => 'nullable|string',
            'street_unit' => 'required|string',
            'postal_code' => 'required|string',
            'city' => 'required|string',
        ]);

        if ($validated->fails()) {
            return response()->json([
                'status' => 'false',
                'message' => 'Validation failed',
                'error' => $validated->errors(),
            ], 400);
        }

        $invoice = Invoice::create([
            'account_id' => $request->account_id,
            'company' => $request->company,
            'eu_tax_number' => $request->eu_tax_number,
            'street_unit' => $request->street_unit,
            'postal_code' => $request->postal_code,
            'city' => $request->city,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Invoice created successfully',
            'invoice' => $invoice,
        ], 201);
    }



    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Failed',
                'error' => $validator->errors()->all()
            ], 422);
        }

        $account = Account::where('email', $request->email)->first();

        if (!$account || !Hash::check($request->password, $account->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Check if the role is "buyer"
        if ($account->role !== 'buyer') {
            return response()->json([
                'status' => false,
                'message' => 'Access denied. Only buyers can log in.'
            ], 403);
        }
        if (Payment::where('account_id', $account->id)->first()->payment_status !== 'succeeded') {
            return response()->json([
                'status' => false,
                'message' => 'Payment failed. Access denied.'
            ], 403);
        }

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'account' => $account,
            'token' => $account->createToken('API Token')->plainTextToken
        ], 200);
    }

    public function sellerLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Failed',
                'error' => $validator->errors()->all()
            ], 422);
        }

        $account = Account::where('email', $request->email)->first();

        if (!$account || !Hash::check($request->password, $account->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Check if the role is "seller"
        if ($account->role !== 'seller') {
            return response()->json([
                'status' => false,
                'message' => 'Access denied. Only sellers can log in.'
            ], 403);
        }
        if (Payment::where('account_id', $account->id)->first()->payment_status !== 'succeeded') {
            return response()->json([
                'status' => false,
                'message' => 'Payment failed. Access denied.'
            ], 403);
        }

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'account' => $account,
            'token' => $account->createToken('API Token')->plainTextToken
        ], 200);
        // ->withCookie(cookie('token', '1', 15))
        // ->sameSite('None')
        // ->secure(true); // Set to true if you're using https
    }
    /******  4bf2edd3-07e1-4013-a075-b3b2ef3a3415  *******/



    public function getSellers()
    {
        $sellers = Account::where('role', 'seller')->get();

        if ($sellers->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No sellers found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Sellers retrieved successfully',
            'data' => $sellers,
        ], 200);
    }

    public function getBuyers()
    {
        $buyers = Account::where('role', 'buyer')->get();

        if ($buyers->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No buyers found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Buyers retrieved successfully',
            'data' => $buyers,
        ], 200);
    }

    public function authInfo()
    {
        // Retrieve authenticated account
        $account = Auth::user();

        if ($account) {
            return response()->json([
                'success' => true,
                'data' => $account,
                'message' => 'Account data retrieved successfully',
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Unauthorized',
        ], 401);
    }


    public function couponusage()
    {
        $accounts = Account::with(['coupon.influencer'])
            ->whereNotNull('coupon_id')
            ->orderBy('id', 'desc')->paginate(10);
        return view('admin.couponusage.couponusageslist', compact('accounts'));
    }
}
