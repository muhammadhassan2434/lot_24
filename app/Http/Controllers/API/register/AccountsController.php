<?php

namespace App\Http\Controllers\API\register;

use Illuminate\Support\Facades\Validator;
use App\Models\Account;
use App\Models\Invoice;
use App\Models\Subscription;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::all();
        return view('admin.Accounts.accountslist', compact('accounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

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



    public function storeAccounts(Request $request){
        $validated = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:accounts',
            'password' => 'required|min:8',
            'phone_number' => 'nullable|string',
            'country' => 'required|string',
            'role' => 'required|in:buyer,seller',
            'subscription_id' => 'required',
            'company' => 'required_if:want_invoice,true',
            'street_unit' => 'required_if:want_invoice,true',
            'postal_code' => 'required_if:want_invoice,true',
            'city' => 'required_if:want_invoice,true',
        ]);

        if ($validated->fails()) {
            return response()->json([
                'status' => 'false',
                'message' => 'Validation failed',
                'error' => $validated->errors(),
            ], 400);
        }

        $account = Account::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'country' => $request->country,
            'role' => $request->role,
            'subscription_id' => $request->subscription_id,
        ]);
        if ($request->want_invoice) {
            Invoice::create([
                'account_id' => $account->id,
                'company' => $request->company,
                'eu_tax_number' => $request->eu_tax_number,
                'street_unit' => $request->street_unit,
                'postal_code' => $request->postal_code,
                'city' => $request->city,
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Account created successfully',
            'Account' => $account,

            // Return image URL in response
        ], 201);
    }



    
    public function login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required',
        'role' => 'required'
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
        'role' => 'required'
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
    if ($account->role !== 'seller') {
        return response()->json([
            'status' => false,
            'message' => 'Access denied. Only sellers can log in.'
        ], 403);
    }

    return response()->json([
        'status' => true,
        'message' => 'Login successful',
        'account' => $account,
        'token' => $account->createToken('API Token')->plainTextToken
    ], 200);
}

    

}
