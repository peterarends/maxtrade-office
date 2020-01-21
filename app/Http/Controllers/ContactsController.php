<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Resources\Contact as ContactResource;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index(Request $request)
    {
        /** Get Contacts */
        $contacts = Contact::where(['user_id' => $request->id])
            ->orderBy('created_at', 'desc')
            ->get();

        /** Return collection of Contacts as resource */
        return ContactResource::collection($contacts);
    }

    public function store(Request $request)
    {
        $contact = $request->isMethod('put') ? Contact::findOrFail($request->contact_id) : new Contact;

        $contact->name = $request->input('name');
        $contact->phone = $request->input('phone');
        $contact->description = $request->input('description');
        if ($request->isMethod('post')) {
            $contact->user_id = $request->input('user_id');
        }

        if ($contact->save()) {
            return new ContactResource($contact);
        }
    }

    public function show($id)
    {
        /** Get a Contact */
        $contact = Contact::findOrFail($id);

        /** Return a single contact as resource */
        return new ContactResource($contact);
    }

    public function destroy($id)
    {
        /** Get a Contact */
        $contact = Contact::findOrFail($id);

        if ($contact->delete()) {
            return new ContactResource($contact);
        }
    }
}