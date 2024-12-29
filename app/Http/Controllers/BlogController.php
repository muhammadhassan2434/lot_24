<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs= Blog::all();
        return view('admin.Blogs.bloglist', compact('blogs'));
    }

    public function create()
    {
        return view('admin.Blogs.createblog');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator::make(
            $request->all(),
            [
                'image' => 'nullable|mimes:png,jpg,jpeg,gif',
                'title' => 'required',
                'description' => 'required',

            ]
            );
            if($validator->fails()){
                return redirect()->back()->withErrors($validator->errors());
            }
            $img =$request->image;
            $ext = $img->getClientOriginalExtension();
            $imagename = time().'.'.$ext;
            $img->move(public_path().'/uploads',$imagename);

            $blogs = Blog::create([
                'image' =>$imagename,
                'title' => $request->title,
                'description' => $request->description,

            ]);
            return redirect()->route('blog.index')->with('sucess',"Blog Created SuccessFully");

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $Blog=Blog::all();
        if($Blog->isEmpty()){
            return response()->json([
                'status' => 'False',
                'message' => 'No Blog Found',
            ]);
        }
        return response()->json([
            'status' => 'True',
            'message' => 'Blog Found',
            'data' => $Blog,
            ]);
    }

    public function edit(string $id)
    {
        $blog=Blog::find($id);
        return view('admin.Blogs.editblog',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $blog = Blog::find($id);

        // Validate the inputs
        $validated = $request->validate([
            'new_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required',
            'description' => 'required',

             // Validate new image
        ]);
    // Handle image upload
    if ($request->hasFile('new_image')) {
        // Delete old image if it exists
        if ($blog->image && file_exists(public_path('uploads/' . $blog->image))) {
            unlink(public_path('uploads/' . $blog->image));
        }

        // Upload the new image
        $newImageName = time() . '-' . $request->file('new_image')->getClientOriginalName();
        $request->file('new_image')->move(public_path('uploads'), $newImageName);

        // Save the new image path to the database
        $blog->image = $newImageName;}
        // Update other fields
        $blog->title = $request->input('title');
        $blog->description = $request->input('description');


        $blog->save();

        return redirect()->route('blog.index')->with('success', 'Blog updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog= Blog::find($id);
        $blog->delete($id);
        return redirect()->route('blog.index');
    }
}