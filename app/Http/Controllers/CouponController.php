<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Influencer;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    public function index()
    {
        $coupons=Coupon::all();
        return view('admin.Coupon.couponlist', compact('coupons'));
    }

    public function create()
    {
        $influencer = Influencer::all();
        return view('admin.Coupon.createcoupon',compact('influencer'));
    }

    public function store(Request $request){
        // dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                'code' => 'required|unique:coupons',
                'discount' => 'required',
                'influencer_id' => 'required',
                'expiry_date' => 'required',
                'status' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
                }

                $coupon =Coupon::create([
                    'code' => $request->code,
                    'discount' => $request->discount,
                    'influencer_id' => $request->influencer_id,
                    'expiry_date' => $request->expiry_date,
                    'status' => $request->status,
                ]);

                return redirect()->route('coupon.index')->with('success', 'Coupon created Successfully');
    }
    public function edit(string $id)
    {
        $coupon=Coupon::find($id);
        $influencers = Influencer::all();
        return view('admin.Coupon.editcoupon',compact('coupon','influencers'));
    }

    public function update(Request $request, string $id){
        // dd($request->all());
        $coupon=Coupon::find($id);
        $validator = Validator::make(
            $request->all(),
            [
                'code' => 'required|unique:coupons,code,' . $id,
                'discount' => 'required',
                'influencer_id' => 'required',
                'expiry_date' => 'required',
                'status' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
                }

                $coupon->code = $request->code;
                $coupon->discount = $request->discount;
                $coupon->influencer_id = $request->influencer_id;
                $coupon->expiry_date = $request->expiry_date;
                $coupon->status = $request->status;

                $coupon->save();


                return redirect()->route('coupon.index')->with('success', 'Coupon Updated Successfully');
    }
    public function destroy(string $id)
    {
        $coupon= Coupon::find($id);
        $coupon->delete($id);
        return redirect()->route('coupon.index');
    }


}