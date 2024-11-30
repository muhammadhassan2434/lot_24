<?php

namespace App\Http\Controllers\admin;

use App\Models\Subcategory;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubcategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = SubCategory::all();
        return view('admin.subcategories.subcategories', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = category::all();
        return view('admin.subcategories.createsubcategories', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all(), [
            'name' => 'required|unique:categories',
            'category_id' => 'required|exists:categories,id',
            'slug' => 'nullable',
            'status' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $subcategory = new subCategory();
        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category_id;
        $subcategory->slug = $request->slug;
        $subcategory->status = $request->status;

        $subcategory->save();
        return redirect()->route('subcategory.index')->with('success','SubCategory created successfully');
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
        $subcategory = subCategory::find($id);
        $categories = Category::all();
        return view('admin.subcategories.editsubcategories', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subcategory = subCategory::find($id);
        $validator = validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'slug' => 'nullable',
            'status' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors());
            }
            $subcategory->name = $request->name;
            $subcategory->category_id = $request->category_id;
            $subcategory->slug = $request->slug;
            $subcategory->status = $request->status;
            $subcategory->update();

            return redirect()->route('subcategory.index')->with('success','SubCategory Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategory = subcategory::find($id);
        $subcategory->delete($id);
        return redirect()->route('subcategory.index');
    }
}
