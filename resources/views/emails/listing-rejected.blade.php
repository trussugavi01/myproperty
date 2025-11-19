@component('mail::message')
# Update Required for Your Property Listing

Your property listing "{{ $property->title }}" requires some updates before it can be published.

## Reason for Rejection

{{ $property->rejection_notes }}

## What to Do Next

Please review the feedback above and update your listing accordingly. Once you've made the necessary changes, your listing will be reviewed again.

@component('mail::button', ['url' => route(auth()->user()->role . '.properties.edit', $property)])
Edit Your Listing
@endcomponent

If you have any questions, please don't hesitate to contact our support team.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
