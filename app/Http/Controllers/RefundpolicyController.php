<?php

namespace App\Http\Controllers;

use App\Models\Refundpolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RefundpolicyController extends Controller
{
    public function index(){
        $terms = Refundpolicy::all();
        return view('admin.refundpolicy.refundpolicy', compact('terms'));
    }
    public function create(){
        return view('admin.refundpolicy.createrefundpolicy');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'nullable',
            'Description' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
            }

       $terms =Refundpolicy::create([
        'title' => $request->title,
        'Description' => $request->Description
       ]);

       return redirect()->route('refund.index')->with('sucess',"Refund Policy Created SuccessFully");
    }
 public function show()
    {
        $Term=Refundpolicy::all();
        if($Term->isEmpty()){
            return response()->json([
                'status' => 'False',
                'message' => 'No Refund Policy Found',
            ]);
        }
        return response()->json([
            'status' => 'True',
            'message' => 'Refund Policy Found',
            'data' => $Term,
            ]);
    }
    public function edit(string $id){
        $terms= Refundpolicy::find($id);
        return view('admin.refundpolicy.editrefund',compact('terms'));
    }

    public function update(Request $request,string $id){
        $term= Refundpolicy::find($id);
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'Description' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
            }

         $term->title = $request->input('title');
         $term->Description = $request->input('Description');
         $term->save();
         return redirect()->route('refund.index')->with('sucess',"Refund Policy Updated SuccessFully");
    }
    public function destroy(string $id){
        $term= Refundpolicy::find($id);
        $term->delete($id);
        return redirect()->route('refund.index')->with('sucess',"Refund Policy Deleted SuccessFully");
    }
}
