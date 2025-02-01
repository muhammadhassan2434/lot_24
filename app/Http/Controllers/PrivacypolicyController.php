<?php

namespace App\Http\Controllers;

use App\Models\Privacypolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrivacypolicyController extends Controller
{
    public function index(){
        $terms = Privacypolicy::all();
        return view('admin.privacypolicy.privacypolicy', compact('terms'));
    }
    public function create(){
        return view('admin.privacypolicy.createreprivacypolicy');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'nullable',
            'Description' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
            }

       $terms =Privacypolicy::create([
        'title' => $request->title,
        'Description' => $request->Description
       ]);

       return redirect()->route('privacy.index')->with('sucess',"Privacy Policy Created SuccessFully");
    }
 public function show()
    {
        $Term=Privacypolicy::all();
        if($Term->isEmpty()){
            return response()->json([
                'status' => 'False',
                'message' => 'No Privacy Policy Found',
            ]);
        }
        return response()->json([
            'status' => 'True',
            'message' => 'Privacy Policy Found',
            'data' => $Term,
            ]);
    }
    public function edit(string $id){
        $terms= Privacypolicy::find($id);
        return view('admin.privacypolicy.editprivacy',compact('terms'));
    }

    public function update(Request $request,string $id){
        $term= Privacypolicy::find($id);
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
         return redirect()->route('privacy.index')->with('sucess',"Privacy Policy Updated SuccessFully");
    }
    public function destroy(string $id){
        $term= Privacypolicy::find($id);
        $term->delete($id);
        return redirect()->route('privacy.index')->with('sucess',"Privacy Policy Deleted SuccessFully");
    }

}
