<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return view('admin.color.colorList', compact('colors'));
    }
    public function create()
    {
        return view('admin.color.createcolor');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'color' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors('error', $validator->errors())->withInput();
        }
        $color = new Color();
        $color->title = $request->title;
        $color->color = $request->color;
        $color->save();
        return redirect()->route('color.index');
    }

    public function edit($id)
    {
        $color = Color::find($id);
        return view('admin.color.editcolor', compact('color'));
    }
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'color' => 'required'
        ]);

        // Redirect back with errors if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        }

        // Find the existing color record by ID
        $color = Color::findOrFail($id); // Use findOrFail to throw an exception if the record doesn't exist

        // Update the color fields
        $color->title = $request->title;
        $color->color = $request->color;

        // Save the updated record
        $color->save();

        // Redirect to the index route with a success message
        return redirect()->route('color.index')->with('success', 'Color updated successfully!');
    }

    public function destroy($id)
    {
        $color = Color::find($id);
        $color->delete();
        return redirect()->route('color.index');
    }

    public function getColors()
    {
        $colors = Color::all();
        return response()->json($colors);
    }
}
