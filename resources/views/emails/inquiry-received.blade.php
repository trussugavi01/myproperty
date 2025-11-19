@component('mail::message')
# New Inquiry for Your Property

You have received a new inquiry for your property: **{{ $inquiry->property->title }}**

## Inquiry Details

**From:** {{ $inquiry->name }}  
**Email:** {{ $inquiry->email }}  
@if($inquiry->phone)
**Phone:** {{ $inquiry->phone }}
@endif

**Message:**  
{{ $inquiry->message }}

@component('mail::button', ['url' => route(auth()->user()->role . '.inquiries.show', $inquiry)])
View Inquiry
@endcomponent

Please respond to this inquiry as soon as possible to maintain good customer relations.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
