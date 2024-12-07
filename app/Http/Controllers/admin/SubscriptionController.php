<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscription = Subscription::all();
        return view('admin.subscription.subscriptionlist', compact('subscription'));
    }
    public function showsubscription()
    {
        $subscription = Subscription::all();

        if($subscription->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No Subscription found.',
            ]);
        }
        return response()->json([
            'status' => 'success',
            'data' => $subscription,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subscription.createsubscription');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeData(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'plan_name' => 'required',
            'Actual_Price' => 'required',
            'Discount_Price' => 'required',
            'plan_duration' => 'required',
            'status' => 'required',

        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors('error' , $validator->errors())->withInput();
        }


                $subscription = new Subscription();
                $subscription->plan_name = $request->input('plan_name');
                $subscription->Actual_Price = $request->input('Actual_Price');
                $subscription->Discount_Price = $request->input('Discount_Price');
                $subscription->plan_duration = $request->input('plan_duration');
                $subscription->status = $request->input('status');
                $subscription->save();

                return redirect()->route('subscription.index')->with('sucess',"Subscription Created SuccessFully");

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subscription = Subscription::find($id);
        return view('admin.subscription.editsubscription', compact('subscription'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subscription = Subscription::find($id);
        $validator = Validator::make($request->all(),[
            'plan_name' => 'required',
            'Actual_Price' => 'required',
            'Discount_Price' => 'required',
            'plan_duration' => 'required',
            'status' => 'required',

        ]);

                $subscription->plan_name= $request->input('plan_name');
                $subscription->Actual_Price= $request->input('Actual_Price');
                $subscription->Discount_Price= $request->input('Discount_Price');
                $subscription->plan_duration= $request->input('plan_duration');
                $subscription->status= $request->input('status');
                $subscription->save();
                return redirect()->route('subscription.index')->with('sucess',"Subscription Updated SuccessFully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subscription= Subscription::find($id);
        $subscription->delete($id);
        return redirect()->route('subscription.index');
    }
}
