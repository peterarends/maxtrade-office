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
            ->orderBy('name', 'desc')
            ->get();

        /** Return collection of Contacts as resource */
        return ContactResource::collection($contacts);
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            if (is_array($request->input('contacts'))) {
                foreach ($request->input('contacts') as $contact) {
                    $currentContact = Contact::findOrFail($contact["id"]);
                    $currentContact->name = $contact["name"];
                    $currentContact->phone = $contact["phone"];
                    $currentContact->email = $contact["email"];
                    $currentContact->description = $contact["description"];
                    $currentContact->save();
                }
                return json_encode([
                    "result" => "success"
                ]);
            } else {
                return json_encode([
                    "result" => "The parameter contacts not sendet!"
                ]);
            }
        } else {
            return json_encode([
                "result" => "The request method must be POST!"
            ]);
        }
    }

    public function storeContact(Request $request)
    {
        if ($request->isMethod('post')) {
            $contact = new Contact();
            $contact->name = $request->input('name');
            $contact->phone = $request->input('phone');
            $contact->email = $request->input('email');
            $contact->description = $request->input('description');
            $contact->user_id = $request->input('user_id');
            $contact->save();
            return new ContactResource($contact);
        }
    }

    public function destroy($id)
    {
        /** Get a Contact */
        $contact = Contact::findOrFail($id);

        if ($contact->delete()) {
            return new ContactResource($contact);
        }
    }

    public function search(Request $request)
    {
        if (!empty($request->search)) {
            $contacts = Contact::where([['user_id', '=',  $request->user_id], ['name', 'LIKE', '%' . $request->search . '%']])
                ->orWhere([['user_id', '=', $request->user_id], ['phone', 'LIKE', '%' . $request->search . '%']])
                ->orWhere([['user_id', '=', $request->user_id], ['email', 'LIKE', '%' . $request->search . '%']]);
            $contacts = $contacts->orderBy('name', 'asc');
            $contacts = $contacts->get();

            return ContactResource::collection($contacts);
        } else {
            $contacts = Contact::where(['user_id' => $request->id])
                ->orderBy('name', 'desc')
                ->get();
            return ContactResource::collection($contacts);
        }
    }
}
