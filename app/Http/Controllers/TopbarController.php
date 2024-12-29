<?php

namespace App\Http\Controllers;

use App\Models\Topbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TopbarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topbars= Topbar::all();
        return view('admin.topbar.topbarlist', compact('topbars'));
    }

    public function create()
    {
        return view('admin.topbar.createtopbar');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator::make(
            $request->all(),
            [
                'title' => 'required',
                'slug' => 'required',
                'description' => 'required',
                'color' => 'nullable',


            ]
            );
            if($validator->fails()){
                return redirect()->back()->withErrors($validator->errors());
            }

            $topbar = Topbar::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'description' => $request->description,
                'color' => $request->color,

            ]);
            return redirect()->route('topbar.index')->with('sucess',"Topbar Created SuccessFully");

    }

    /**
     * Display the specified resource.
     */
    public function gettopbar()
    {
        $topbar=Topbar::all();
        if($topbar->isEmpty()){
            return response()->json([
                'status' => 'False',
                'message' => 'No topbar Found',
            ]);
        }
        return response()->json([
            'status' => 'True',
            'message' => 'Topbar Found',
            'data' => $topbar,
            ]);
    }
    public function edit(string $id)
    {
        $topbar=Topbar::find($id);
        return view('admin.topbar.edittopbar',compact('topbar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $topbar=Topbar::find($id);

        $validator = validator::make(
            $request->all(),
            [
                'title' => 'required',
                'slug' => 'required',
                'description' => 'required',
                'color' => 'nullable',

            ]
            );
            if($validator->fails()){
                return redirect()->back()->withErrors($validator->errors());
            }

            $topbar->title = $request->input('title');
            $topbar->slug = $request->input('slug');
            $topbar->description = $request->input('description');
            $topbar->color = $request->input('color');
            $topbar->save();

        return redirect()->route('topbar.index')->with('success', 'Topbar updated successfully!');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $topbar= Topbar::find($id);
        $topbar->delete($id);
        return redirect()->route('topbar.index');
    }
}