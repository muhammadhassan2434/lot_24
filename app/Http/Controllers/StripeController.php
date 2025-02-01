<?php

namespace App\Http\Controllers;

use App\Models\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StripeController extends Controller
{
    public function index(){
        $stripes = Stripe::all();
        return view('admin.stripe.stripeList', compact('stripes'));
    }

    public function create(){
        return view('admin.stripe.createstripe');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'secretkey' => 'required',
            'publisherkey' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
            }

       $stripe =Stripe::create([
        'secretkey' => $request->secretkey,
        'publisherkey' => $request->publisherkey
       ]);

       return redirect()->route('stripe.index')->with('sucess',"Stripe Created SuccessFully");
    }

    // public function show()
    // {
    //     $stripe=Stripe::all();
    //     if($stripe->isEmpty()){
    //         return response()->json([
    //             'status' => 'False',
    //             'message' => 'No Stripe Account Found',
    //         ]);
    //     }
    //     return response()->json([
    //         'status' => 'True',
    //         'message' => 'Stripe Account Found',
    //         'data' => $stripe,
    //         ]);
    // }

    public function edit(string $id){
        $stripe= Stripe::find($id);
        return view('admin.stripe.editstripe',compact('stripe'));
    }

    public function update(Request $request,string $id){
        $stripe= Stripe::find($id);
        $validator = Validator::make($request->all(), [
            'secretkey' => 'required',
            'publisherkey' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
            }

         $stripe->secretkey = $request->input('secretkey');
         $stripe->publisherkey = $request->input('publisherkey');
         $stripe->save();
         return redirect()->route('stripe.index')->with('sucess',"Stripe Account Updated SuccessFully");
    }

    public function destroy(string $id){
        $stripe= Stripe::find($id);
        $stripe->delete($id);
        return redirect()->route('stripe.index')->with('sucess',"Stripe Acccount  Deleted SuccessFully");
    }

}
