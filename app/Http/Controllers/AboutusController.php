<?php

namespace App\Http\Controllers;

use App\Models\Aboutus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutusController extends Controller
{
    public function index(){
        $terms = Aboutus::all();
        return view('admin.aboutus.aboutus', compact('terms'));
    }
    public function create(){
        return view('admin.aboutus.createaboutus');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'nullable',
            'Description' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
            }

       $terms =Aboutus::create([
        'title' => $request->title,
        'Description' => $request->Description
       ]);

       return redirect()->route('aboutus.index')->with('sucess',"Aboutus Created SuccessFully");
    }
 public function show()
    {
        $Term=Aboutus::all();
        if($Term->isEmpty()){
            return response()->json([
                'status' => 'False',
                'message' => 'No Aboutus Found',
            ]);
        }
        return response()->json([
            'status' => 'True',
            'message' => 'Aboutus Found',
            'data' => $Term,
            ]);
    }
    public function edit(string $id){
        $terms= Aboutus::find($id);
        return view('admin.aboutus.editaboutus',compact('terms'));
    }

    public function update(Request $request,string $id){
        $term= Aboutus::find($id);
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
         return redirect()->route('aboutus.index')->with('sucess',"Aboutus Updated SuccessFully");
    }
    public function destroy(string $id){
        $term= Aboutus::find($id);
        $term->delete($id);
        return redirect()->route('aboutus.index')->with('sucess',"Aboutus Deleted SuccessFully");
    }
}
