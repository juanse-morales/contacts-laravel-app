<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contactsAll = Contact::all();

        $filteredContacts = collect($contactsAll)->filter(function($item) {
            return $item['is_active'] == 1;
        })->values()->all();

        return response()->json($filteredContacts, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:45',
            'last_name' => 'max:45',
            'gender' => 'max:1',
            'phone_number' => 'required|max:25',
            'email' => 'max:60'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error when validate data',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $contact = Contact::create($request->all());
        
        if (!$contact) {
            $data = [
                'message' => 'Error when creating contact',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'contact' => $contact,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            $data = [
                'message' => 'Contact not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'contact' => $contact,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            $data = [
                'message' => 'Contact not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:45',
            'last_name' => 'max:45',
            'gender' => 'max:1',
            'phone_number' => 'required|max:25',
            'email' => 'max:60'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error when validate data',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $contact->name = $request->name;
        $contact->last_name = $request->last_name;
        $contact->age = $request->age;
        $contact->gender = $request->gender;
        $contact->phone_number = $request->phone_number;
        $contact->email = $request->email;

        $contact->save();

        $data = [
            'message' => 'Contact updated',
            'auto' => $contact,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            $data = [
                'message' => 'Contact not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        
        $contact->is_active = 0;
        $contact->is_deleted = 1;

        $contact->save();

        $data = [
            'message' => 'Contact deleted',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource from storage to Blocked.
     */
    public function block(string $id) {
        $contact = Contact::find($id);

        if (!$contact) {
            $data = [
                'message' => 'Contact not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $contact->is_active = 0;
        $contact->is_blocked = 1;

        $contact->save();

        $data = [
            'message' => 'Contact updated',
            'auto' => $contact,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource from storage to Archived.
     */
    public function archive(string $id) {
        $contact = Contact::find($id);

        if (!$contact) {
            $data = [
                'message' => 'Contact not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $contact->is_active = 0;
        $contact->is_archived = 1;

        $contact->save();

        $data = [
            'message' => 'Contact updated',
            'auto' => $contact,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource from storage to Active.
     */
    public function restore(string $id) {
        $contact = Contact::find($id);

        if (!$contact) {
            $data = [
                'message' => 'Contact not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $contact->is_active = 1;
        $contact->is_blocked = 0;
        $contact->is_deleted = 0;
        $contact->is_archived = 0;

        $contact->save();

        $data = [
            'message' => 'Contact updated',
            'auto' => $contact,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
