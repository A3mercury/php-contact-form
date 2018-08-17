<?php

namespace App\Mail;

use App\ContactRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactRequestEmail extends Mailable implements ShouldQueue
{
    use SerializesModels, Queueable;

    private $contact_request;

    public function __construct(ContactRequest $contact_request)
    {
        $this->contact_request = $contact_request;
    }

    public function build()
    {
        return $this
            ->subject('New Contact Request from ' . $this->contact_request->full_name)
            ->markdown('mail.contact_request', [
                'contact_request' => $this->contact_request,
            ]);
    }
}
