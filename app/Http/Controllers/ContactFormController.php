<?php

namespace App\Http\Controllers;

use App\ContactRequest;
use App\Mail\ContactRequestEmail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function store()
    {
        // Validate the request
        $this->validate(request(), [
            'full_name' => 'required|string|max:48',
            'email' => 'required|string|max:48',
            'message' => 'required|string|max:2000',
            'phone' => 'nullable|string',
        ]);

        // Store the contact request in the database
        $contact_request = ContactRequest::create([
            'full_name' => request()->get('full_name'),
            'email' => request()->get('email'),
            'message' => request()->get('message'),
            'phone' => request()->get('phone'),
        ]);

        // Email a copy of the contact request to `guy-smiley@example.com`
        Mail::to('guy-smiley@example.com')->send(new ContactRequestEmail($contact_request));

        // Return to the homepage with success
        return json_encode([
            'success' => true,
            'message' => 'We have recieved your contact request and will be in touch with you soon!',
        ]);
    }
}
