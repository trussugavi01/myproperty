# ZeptoMail Setup Guide

This guide will help you configure ZeptoMail for sending transactional emails in your Laravel application.

## Prerequisites

1. A ZeptoMail account (sign up at https://www.zoho.com/zeptomail/)
2. A verified domain for sending emails

## Step 1: Get ZeptoMail Credentials

1. Log in to your ZeptoMail account
2. Go to **Settings** → **SMTP**
3. Note down the following:
   - **SMTP Host:** `smtp.zeptomail.com`
   - **SMTP Port:** `587` (TLS) or `465` (SSL)
   - **Username:** Your ZeptoMail SMTP username
   - **Password:** Your ZeptoMail SMTP password

## Step 2: Configure Environment Variables

Open your `.env` file and update the mail configuration:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.zeptomail.com
MAIL_PORT=587
MAIL_USERNAME=your_zeptomail_username
MAIL_PASSWORD=your_zeptomail_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@property.com.ng"
MAIL_FROM_NAME="${APP_NAME}"
```

**Important:** Replace the following:
- `your_zeptomail_username` with your actual ZeptoMail SMTP username
- `your_zeptomail_password` with your actual ZeptoMail SMTP password
- `noreply@property.com.ng` with your verified sender email address

## Step 3: Verify Your Domain

1. In ZeptoMail, go to **Mail Agents** → **Add Mail Agent**
2. Add your domain (e.g., `property.com.ng`)
3. Add the required DNS records (SPF, DKIM, DMARC) to your domain's DNS settings
4. Wait for verification (usually takes a few minutes to 24 hours)

## Step 4: Test Email Configuration

Run this command to test your email configuration:

```bash
php artisan tinker
```

Then in the tinker console:

```php
Mail::raw('Test email from Property.com.ng', function ($message) {
    $message->to('your-email@example.com')
            ->subject('Test Email');
});
```

Check your inbox for the test email.

## Available Email Templates

The following transactional emails have been configured:

### 1. Welcome Email
**Trigger:** Sent when a new user registers
**File:** `app/Mail/WelcomeEmail.php`
**Template:** `resources/views/emails/welcome.blade.php`

**Usage:**
```php
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

Mail::to($user->email)->send(new WelcomeEmail($user));
```

### 2. Password Reset Email
**Trigger:** Sent when a user requests a password reset
**File:** `app/Notifications/ResetPasswordNotification.php`
**Automatically sent by Laravel's password reset system**

### 3. Email Verification
**Trigger:** Sent when a user needs to verify their email
**Template:** `resources/views/emails/verify-email.blade.php`

### 4. Inquiry Received
**Trigger:** Sent when a property inquiry is received
**Template:** `resources/views/emails/inquiry-received.blade.php`

### 5. Listing Approved
**Trigger:** Sent when a property listing is approved
**Template:** `resources/views/emails/listing-approved.blade.php`

### 6. Listing Rejected
**Trigger:** Sent when a property listing is rejected
**Template:** `resources/views/emails/listing-rejected.blade.php`

### 7. Payment Confirmation
**Trigger:** Sent when a payment is confirmed
**Template:** `resources/views/emails/payment-confirmation.blade.php`

## Sending Welcome Email on Registration

To automatically send a welcome email when users register, add this to your registration controller:

```php
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

// After user registration
Mail::to($user->email)->send(new WelcomeEmail($user));
```

## Queue Configuration (Recommended)

For better performance, send emails asynchronously using queues:

1. Update `.env`:
```env
QUEUE_CONNECTION=database
```

2. Run migrations:
```bash
php artisan queue:table
php artisan migrate
```

3. Update your Mailable to implement `ShouldQueue`:
```php
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeEmail extends Mailable implements ShouldQueue
{
    // ...
}
```

4. Start the queue worker:
```bash
php artisan queue:work
```

## Monitoring Email Delivery

1. **ZeptoMail Dashboard:** Check email delivery status in your ZeptoMail dashboard
2. **Laravel Logs:** Check `storage/logs/laravel.log` for email errors
3. **Failed Jobs:** Monitor failed queue jobs with `php artisan queue:failed`

## Troubleshooting

### Emails not sending
- Verify your ZeptoMail credentials in `.env`
- Check if your domain is verified in ZeptoMail
- Review Laravel logs: `storage/logs/laravel.log`
- Test SMTP connection: `php artisan config:clear && php artisan cache:clear`

### Authentication failed
- Double-check your SMTP username and password
- Ensure you're using the correct SMTP host and port
- Verify your ZeptoMail account is active

### Emails going to spam
- Ensure SPF, DKIM, and DMARC records are properly configured
- Use a verified sender domain
- Avoid spam trigger words in subject lines

## Best Practices

1. **Use Queue for Emails:** Always queue emails to avoid blocking requests
2. **Test Thoroughly:** Test all email templates before going to production
3. **Monitor Delivery:** Regularly check ZeptoMail dashboard for delivery rates
4. **Handle Failures:** Implement proper error handling for failed emails
5. **Rate Limits:** Be aware of ZeptoMail's sending limits for your plan

## Support

- **ZeptoMail Support:** https://help.zoho.com/portal/en/community/zeptomail
- **Laravel Mail Documentation:** https://laravel.com/docs/mail

---

**Last Updated:** November 2024
