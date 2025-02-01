<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews=Review::orderby('id','desc')->paginate(10);
        return view('admin.Reviews.reviewslist',compact('reviews'));
    }

    public function show()
    {
        $reviews=Review::all();
        if (!$reviews) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found',
            ], 404);
        }
        return response()->json([
            'status' => true,
            'message' => 'Review found',
            'data' => $reviews
            ], 200);

    }
    public function create()
    {
        return view('admin.Reviews.createreview');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'description' => 'nullable'

            ]
            );
            if($validator->fails()){
                return redirect()->back()->withErrors($validator->errors());
            }

            Review::create([
                'name' => $request->name,
                'description' => $request->description
            ]);
            return redirect()->route('review.index')->with('success','Review created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function edit(string $id)
    {
        $review =Review::find($id);
        return view('admin.Reviews.editreview',compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $review =Review::find($id);
        $validator = validator::make(
            $request->all(),
            [
                'name' => 'required',
                'description' => 'nullable'

            ]
            );
            if($validator->fails()){
                return redirect()->back()->withErrors($validator->errors());
            }
            $review->name = $request->input('name');
            $review->description = $request->input('description');

            $review->save();
            return redirect()->route('review.index')->with('success','Review updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review= Review::find($id);
        $review->delete($id);
        return redirect()->route('review$review.index');
    }
}
