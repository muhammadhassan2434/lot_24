<?php

namespace App\Http\Controllers;

use App\Models\SocialMedia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function index(){
        $medias = SocialMedia::all();
        return view('admin.socialmedia.socialmediaList', compact('medias'));
    }

    public function create(){
        return view('admin.socialmedia.createsocialmedia');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'link' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
            }

       $media =SocialMedia::create([
        'title' => $request->title,
        'link' => $request->link
       ]);

       return redirect()->route('media.index')->with('sucess',"Social Media Created SuccessFully");
    }

    public function show()
    {
        $media=SocialMedia::all();
        if($media->isEmpty()){
            return response()->json([
                'status' => 'False',
                'message' => 'No Social Media Found',
            ]);
        }
        return response()->json([
            'status' => 'True',
            'message' => 'Social Media Found',
            'data' => $media,
            ]);
    }

    public function edit(string $id){
        $media= SocialMedia::find($id);
        return view('admin.socialmedia.editsocialmedia',compact('media'));
    }

    public function update(Request $request,string $id){
        $media= SocialMedia::find($id);
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'link' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
            }

         $media->title = $request->input('title');
         $media->link = $request->input('link');
         $media->save();
         return redirect()->route('media.index')->with('sucess',"Social Media Updated SuccessFully");
    }

    public function destroy(string $id){
        $media= SocialMedia::find($id);
        $media->delete($id);
        return redirect()->route('media.index')->with('sucess',"Social Media Deleted SuccessFully");
    }

}


