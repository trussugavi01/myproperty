# Branding Update - Property.com.ng

## Summary
All references to "PropertyNG" have been updated to "Property.com.ng" throughout the application.

## Changes Made

### 1. Configuration Files
- **`.env.example`**
  - Updated `APP_NAME` to "Property.com.ng"
  - Updated `APP_URL` to "https://property.com.ng"
  - Updated `MAIL_FROM_ADDRESS` to "noreply@property.com.ng"

### 2. Views Updated
- **`resources/views/layouts/public.blade.php`**
  - Navbar brand: "Property.com.ng"
  - Footer brand: "Property.com.ng"
  - Footer email: info@property.com.ng
  - Contact email: support@property.com.ng
  - Copyright: "© 2025 Property.com.ng. All rights reserved."

- **`resources/views/layouts/app.blade.php`**
  - Admin sidebar brand: "Property.com.ng"

### 3. Database Seeders
- **`database/seeders/DatabaseSeeder.php`**
  - Admin email: admin@property.com.ng
  - Agent email: agent@property.com.ng
  - Landlord email: landlord@property.com.ng
  - Developer email: developer@property.com.ng

### 4. Documentation
- **`README.md`**
  - Title: "Property.com.ng - Nigeria's premier property listing platform"
  - Updated all default user emails

- **`INSTALLATION.md`**
  - Updated all login credentials to use @property.com.ng

## Email Addresses

### System Emails
- **No Reply**: noreply@property.com.ng
- **General Info**: info@property.com.ng
- **Support**: support@property.com.ng

### Default User Accounts
- **Admin**: admin@property.com.ng
- **Agent**: agent@property.com.ng
- **Landlord**: landlord@property.com.ng
- **Developer**: developer@property.com.ng

## Next Steps

1. **Update .env file** (not tracked in git):
   ```bash
   APP_NAME="Property.com.ng"
   APP_URL=https://property.com.ng
   MAIL_FROM_ADDRESS="noreply@property.com.ng"
   ```

2. **Re-seed the database** (if needed):
   ```bash
   php artisan migrate:fresh --seed
   ```

3. **Clear cache**:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   php artisan view:clear
   ```

4. **Update DNS records** to point property.com.ng to your server

5. **Configure SSL certificate** for https://property.com.ng

## Domain Configuration

When deploying to production:
- Point A record to your server IP
- Configure SSL/TLS certificate (Let's Encrypt recommended)
- Update `.env` with production URL
- Configure email service (SMTP/SendGrid/Mailgun) with proper domain authentication
