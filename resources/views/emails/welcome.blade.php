@component('mail::message')
# Welcome to {{ config('app.name') }}!

Hello {{ $user->name }},

Thank you for joining **{{ config('app.name') }}**, Nigeria's premier property listing and management platform!

We're excited to have you on board. Here's what you can do with your account:

@if($user->role === 'agent')
## For Agents
- **List Properties:** Add and manage your property listings
- **Track Inquiries:** Respond to potential buyers and renters
- **Analytics Dashboard:** Monitor your property performance
- **Professional Profile:** Showcase your expertise
@elseif($user->role === 'landlord')
## For Landlords
- **Property Management:** List and manage your properties
- **Tenant Communication:** Handle inquiries efficiently
- **Payment Tracking:** Monitor rental payments
- **Reports & Analytics:** Track property performance
@else
## For Users
- **Browse Properties:** Explore thousands of listings
- **Save Favorites:** Keep track of properties you love
- **Contact Agents:** Connect directly with property owners
- **Get Alerts:** Receive notifications for new listings
@endif

@component('mail::button', ['url' => route('dashboard')])
Go to Dashboard
@endcomponent

## Getting Started

1. **Complete Your Profile:** Add your details and preferences
2. **Explore Features:** Familiarize yourself with the platform
3. **Get Support:** Contact us anytime at support@property.com.ng

If you have any questions or need assistance, our support team is here to help!

Thanks,<br>
{{ config('app.name') }} Team

---

*This is an automated message. Please do not reply to this email.*
@endcomponent
