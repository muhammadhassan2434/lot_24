<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator ;

class contactInfoController extends Controller
{
    public function index(){
        $contactInfos = ContactInfo::all();
        return view('admin.contactInfo.infoList',compact('contactInfos'));
    }

    public function create(){
        return view('admin.contactInfo.createInfo');
    }

    public function store(Request $request){
        $request->validate([
        ]);
        
        $validator = Validator::make($request->all(),[
            'phone' => 'required',
            'email' => 'required',
            'company_info' => 'required',

        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $contact_info = new ContactInfo();
        $contact_info->phone = $request->input('phone');
        $contact_info->email = $request->input('email');
        $contact_info ->company_info = $request->input('company_info');  
        $contact_info->save();

        return redirect()->route('contactInfo.index')->with('success', 'Contact Info Updated Successfully');
    }
    public function edit($id)
{
    // Find the contact information by its ID
    $contact_info = ContactInfo::findOrFail($id);

    return view('admin.contactInfo.editInfo', compact('contact_info'));
}

public function update(Request $request, $id)
{
    $request->validate([
        // Add validation rules as necessary
    ]);

    $validator = Validator::make($request->all(), [
        'phone' => 'required',
        'email' => 'required',
        'company_info' => 'required',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Find the contact info to update
    $contact_info = ContactInfo::findOrFail($id);
    $contact_info->phone = $request->input('phone');
    $contact_info->email = $request->input('email');
    $contact_info->company_info = $request->input('company_info');
    $contact_info->save();

    return redirect()->route('contactInfo.index')->with('success', 'Contact Info Updated Successfully');
}

public function destroy($id){
    $contact_info = ContactInfo::findOrFail($id);
    $contact_info->delete();
    return redirect()->route('contactInfo.index')->with('success', 'Contact Info Deleted Successfully');
}


public function getInfo(){
    $contactInfo = ContactInfo::all();
    if(!$contactInfo->empty()){
        return response()->json([
            'status' => false,
            'data' => 'no data found',
        ]);

    }
    return response()->json([
        'status' => true,
        'data' => $contactInfo,
    ]);
}

}
