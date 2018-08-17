@component('mail::message')

<p><strong>Full Name:</strong> {{ $contact_request->full_name }}</p>

<p><strong>Email:</strong> {{ $contact_request->email }}</p>

<p><strong>Phone Number:</strong> {{ strlen($contact_request->phone) > 0 ? $contact_request->phone : '-' }}</p>

<p><strong>Message:</strong></p>

<p>{{ $contact_request->message }}</p>

@endcomponent
