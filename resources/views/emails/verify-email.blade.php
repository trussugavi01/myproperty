@component('mail::message')
# Verify Your Email Address

Hello {{ $user->name }},

Thank you for registering with **{{ config('app.name') }}**!

To complete your registration and activate your account, please verify your email address by clicking the button below:

@component('mail::button', ['url' => $verificationUrl])
Verify Email Address
@endcomponent

This verification link will expire in 60 minutes.

If you did not create an account, no further action is required.

## Why verify your email?

- **Security:** Ensures your account is protected
- **Communication:** Allows us to send you important updates
- **Full Access:** Unlock all platform features

If you're having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser:

{{ $verificationUrl }}

Thanks,<br>
{{ config('app.name') }} Team

---

*This is an automated message. Please do not reply to this email.*
@endcomponent
