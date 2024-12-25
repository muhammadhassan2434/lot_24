<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Header;
use Illuminate\Support\Facades\Validator;

class HeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $header= Header::all();
        return view('admin.header.headerlist', compact('header'));
    }

    public function create()
    {
        return view('admin.header.createheader');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator::make(
            $request->all(),
            [
                'icon' => 'required|mimes:png,jpg,jpeg,gif',
                'description' => 'required',

            ]
            );
            if($validator->fails()){
                return redirect()->back()->withErrors($validator->errors());
            }
            $img =$request->icon;
            $ext = $img->getClientOriginalExtension();
            $imagename = time().'.'.$ext;
            $img->move(public_path().'/uploads',$imagename);

            $brands = Header::create([
                'icon' =>$imagename,
                'description' => $request->description,

            ]);
            return redirect()->route('header.index')->with('sucess',"Header Created SuccessFully");

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $header=Header::all();
        if(!$header){
            return response()->json([
                'status' => 'False',
                'message' => 'No Header Found',
            ]);
        }
        return response()->json([
            'status' => 'True',
            'message' => 'Header Found',
            'data' => $header,
            ]);
    }

    public function edit(string $id)
    {
        $header=Header::find($id);
        return view('admin.header.editheader',compact('header'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $header = Header::find($id);

        // Validate the inputs
        $validated = $request->validate([
            'new_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',

             // Validate new image
        ]);
    // Handle image upload
    if ($request->hasFile('new_image')) {
        // Delete old image if it exists
        if ($header->icon && file_exists(public_path('uploads/' . $header->icon))) {
            unlink(public_path('uploads/' . $header->icon));
        }

        // Upload the new image
        $newImageName = time() . '-' . $request->file('new_image')->getClientOriginalName();
        $request->file('new_image')->move(public_path('uploads'), $newImageName);

        // Save the new image path to the database
        $header->icon = $newImageName;}
        // Update other fields
        $header->description = $request->input('description');


        $header->save();

        return redirect()->route('header.index')->with('success', 'Header updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $header= Header::find($id);
        $header->delete($id);
        return redirect()->route('header.index');
    }
}
