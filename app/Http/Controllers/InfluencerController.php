<?php

namespace App\Http\Controllers;

use App\Models\Influencer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class InfluencerController extends Controller
{
    public function index()
    {
        $influencers=Influencer::all();
        return view('admin.Influencer.influencerlist', compact('influencers'));
    }

    public function create()
    {
        return view('admin.Influencer.createinfluencer');
    }

    public function store(Request $request){
        // dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email',
                'designation' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
                }

                $influencer =Influencer::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'designation' => $request->designation,
                ]);

                return redirect()->route('influencer.index')->with('success', 'Influencer created Successfully');
    }
    public function edit(string $id)
    {
        $influencer=Influencer::find($id);
        return view('admin.Influencer.editinfluencer',compact('influencer'));
    }

    public function update(Request $request, string $id)
    {
        $influencer=Influencer::find($id);
        $validator = validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email',
                'designation' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
        }

            $influencer->name = $request->input('name');
            $influencer->email = $request->input('email');
            $influencer->designation = $request->input('designation');


            return redirect()->route('influencer.index')->with('success', 'Influencer updated Successfully');
    }

    public function destroy(string $id)
    {
        $influencer= Influencer::find($id);
        $influencer->delete($id);
        return redirect()->route('influencer.index');
    }
}