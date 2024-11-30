<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Validator;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.categorylist', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('admin.category.createcategory');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator::make(
            $request->all(),
            [
                'name' => 'required|unique:categories',
                'slug' => 'nullable',
                'image' => 'required|mimes:png,jpg,jpeg,gif',
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

            $category = Category::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'image' =>$imagename,
                'status' => $request->status,
            ]);
            return redirect()->route('category.index')->with('sucess',"Category Created SuccessFully");


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
        $category = Category::find($id);
        return view('admin.category.editcategory',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
 //Find the category to be updated
    $category = Category::find($id);

    // Validate the inputs
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'nullable|string|max:255',
        'status' => 'required|in:active,block',
        'new_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate new image
    ]);

    // Update other fields
    $category->name = $request->input('name');
    $category->slug = $request->input('slug');
    $category->status = $request->input('status');

    // Handle image upload
    if ($request->hasFile('new_image')) {
        // Delete old image if it exists
        if ($category->image && file_exists(public_path('uploads/' . $category->image))) {
            unlink(public_path('uploads/' . $category->image));
        }

        // Upload the new image
        $newImageName = time() . '-' . $request->file('new_image')->getClientOriginalName();
        $request->file('new_image')->move(public_path('uploads'), $newImageName);

        // Save the new image path to the database
        $category->image = $newImageName;
    }

    // Save the updated category
    $category->save();

    return redirect()->route('category.index')->with('success', 'Category updated successfully!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category= category::find($id);
        $category->delete($id);
        return redirect()->route('category.index');
    }
}
