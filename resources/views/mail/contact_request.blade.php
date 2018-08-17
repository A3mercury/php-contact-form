@component('mail::message')

**Full Name:** {{ $contact_request->full_name }}

**Email:** {{ $contact_request->email }}

**Phone Number:** {{ strlen($contact_request->phone) > 0 ? $contact_request->phone : '-' }}

**Message:**

{{ $contact_request->message }}

@endcomponent
