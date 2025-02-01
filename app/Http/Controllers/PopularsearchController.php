<?php

namespace App\Http\Controllers;

use App\Models\Popularsearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PopularsearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $searches = Popularsearch::paginate(10);
        return view('admin.PopularSearch.searchlist', compact('searches'));
    }

    public function create()
    {
        return view('admin.PopularSearch.createsearch');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator::make(
            $request->all(),
            [
                'search' => 'required',

            ]
            );
            if($validator->fails()){
                return redirect()->back()->withErrors($validator->errors());
            }
            $searches = Popularsearch::create([
                'search' => $request->search,
            ]);
            return redirect()->route('popularsearch.index')->with('sucess',"Search Created SuccessFully");


    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $search=Popularsearch::all();
        if($search->isEmpty()){
            return response()->json([
                'status' => 'False',
                'message' => 'No Search Found',
            ]);
        }
        return response()->json([
            'status' => 'True',
            'message' => 'Searches Found',
            'data' => $search,
            ]);
    }


    public function edit(string $id)
    {
        $search=Popularsearch::find($id);
        return view('admin.PopularSearch.editsearch',compact('search'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $search = Popularsearch::find($id);

        // Validate the inputs
        $validated = $request->validate([
        'search' => 'required',
        ]);
        $search->search = $request->input('search');


        $search->save();

        return redirect()->route('popularsearch.index')->with('success', 'Search updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $search= Popularsearch::find($id);
        $search->delete($id);
        return redirect()->route('popularsearch.index');
    }
}