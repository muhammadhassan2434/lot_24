<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::paginate(10);
        return view('admin.brands.brandslist', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.createbrands');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator::make(
            $request->all(),
            [
                'image' => 'required|mimes:png,jpg,jpeg,gif',
                'name' => 'required|unique:categories',
                'slug' => 'nullable',
                'status'=> 'required'
            ]
            );
            if($validator->fails()){
                return redirect()->back()->withErrors($validator->errors());
            }
            $img =$request->image;
            $ext = $img->getClientOriginalExtension();
            $imagename = time().'.'.$ext;
            $img->move(public_path().'/uploads',$imagename);

            $brands = Brand::create([
                'image' =>$imagename,
                'name' => $request->name,
                'slug' => $request->slug,
                'status' => $request->status,
            ]);
            return redirect()->route('brand.index')->with('sucess',"Brand Created SuccessFully");

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
        $brand=Brand::find($id);
        return view('admin.brands.editbrands',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $brand = Brand::find($id);

        // Validate the inputs
        $validated = $request->validate([
            'new_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'status' => 'required|in:active,block',
             // Validate new image
        ]);
    // Handle image upload
    if ($request->hasFile('new_image')) {
        // Delete old image if it exists
        if ($brand->image && file_exists(public_path('uploads/' . $brand->image))) {
            unlink(public_path('uploads/' . $brand->image));
        }

        // Upload the new image
        $newImageName = time() . '-' . $request->file('new_image')->getClientOriginalName();
        $request->file('new_image')->move(public_path('uploads'), $newImageName);

        // Save the new image path to the database
        $brand->image = $newImageName;}
        // Update other fields
        $brand->name = $request->input('name');
        $brand->slug = $request->input('slug');
        $brand->status = $request->input('status');




        // Save the updated category
        $brand->save();

        return redirect()->route('brand.index')->with('success', 'Brand updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand= Brand::find($id);
        $brand->delete($id);
        return redirect()->route('brand.index');
    }
}