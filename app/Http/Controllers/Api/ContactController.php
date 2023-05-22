<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'message' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                ], 422);
            } else {
                $contact = new Contact();
                $contact->name = $request->name;
                $contact->email = $request->email;
                $contact->phone = $request->phone;
                $contact->message = $request->message;
                $contact->subject = $request->subject;
                $contact->read_status = 0;
                $contact->save();
                return response()->json([
                    'status' => 'success',
                    'message' => 'message-successfully-sent'
                ], 200);
            }
        } catch (Exception) {
            return response()->json([
                'status' => 'error',
            ], 500);
        }
    }
}
