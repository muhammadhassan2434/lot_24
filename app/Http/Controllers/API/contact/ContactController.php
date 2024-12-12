<?php

namespace App\Http\Controllers\API\contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::all();
        return view('admin.Contact.contactlist', compact('contacts'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'massage' => 'required',
        ]);

        // Create a new contact entry
        $contact = Contact::create([
            'name' =>$request->name,
            'email' => $request->email,
            'massage' => $request->massage,
            'status' => 'unread', // Default status
        ]);

        // Return success response
        return response()->json([
            'status' => true,
            'message' => 'Contact message stored successfully',
            'contact' => $contact,
        ], 201);
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    $contact = Contact::findOrFail($id); // Fetch the contact or throw a 404 error
    return view('admin.Contact.contactdetail', compact('contact')); // Pass the contact to the view

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'nullable',
        ]);

        $contact = Contact::find($request->id);
        if (!$contact) {
            return response()->json(['status' => false, 'message' => 'Contact not found'], 404);
        }

        $contact->status = $request->status;
        $contact->save();

        return response()->json([
            'status' => true, // Ensure "status" is boolean
            'message' => 'Status updated successfully'
        ]);
        // return redirect()->route('contact.index')->with('sucess', "Message Read SuccessFully");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact= Contact::find($id);
        $contact->delete($id);
        return redirect()->route('contact.index');
    }
}