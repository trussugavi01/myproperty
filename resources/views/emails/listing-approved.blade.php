@component('mail::message')
# Your Property Listing Has Been Approved!

Great news! Your property listing has been approved and is now live on our platform.

## Property Details

**Title:** {{ $property->title }}  
**Price:** {{ $property->formatted_price }}  
**Location:** {{ $property->location->name ?? 'N/A' }}

@component('mail::button', ['url' => route('properties.show', $property->slug)])
View Your Listing
@endcomponent

Your property is now visible to thousands of potential buyers/renters. We'll notify you when you receive inquiries.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
