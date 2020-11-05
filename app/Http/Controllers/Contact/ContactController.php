<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    private $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function sendContact(Request $request)
    {
        $attr = $request->all();
        $attr['status'] = 0;
        $contact = $this->contact->create($attr);
        if ($contact) {
            return response()->json([
                'status' => 'success',
                'contact' => $contact
            ], 201);
        } else {
            return response()->json([
                'status' => 'fail',
                'message' => 'Fail'
            ], 500);
        }
    }
}
