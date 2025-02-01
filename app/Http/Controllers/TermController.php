<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TermController extends Controller
{
    public function index(){
        $terms = Term::all();
        return view('admin.terms.terms', compact('terms'));
    }
    public function create(){
        return view('admin.terms.createterms');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'nullable',
            'Description' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
            }

       $terms =Term::create([
        'title' => $request->title,
        'Description' => $request->Description
       ]);

       return redirect()->route('term.index')->with('sucess',"Terms Created SuccessFully");
    }
 public function show()
    {
        $Term=Term::all();
        if($Term->isEmpty()){
            return response()->json([
                'status' => 'False',
                'message' => 'No Terms Page Found',
            ]);
        }
        return response()->json([
            'status' => 'True',
            'message' => 'Terms Page Found',
            'data' => $Term,
            ]);
    }
    public function edit(string $id){
        $terms= Term::find($id);
        return view('admin.terms.editterms',compact('terms'));
    }

    public function update(Request $request,string $id){
        $term= Term::find($id);
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
         return redirect()->route('term.index')->with('sucess',"Term Page Updated SuccessFully");
    }
    public function destroy(string $id){
        $term= Term::find($id);
        $term->delete($id);
        return redirect()->route('term.index')->with('sucess',"Term Page  Deleted SuccessFully");
    }
}
