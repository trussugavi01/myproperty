# Property Listing Platform - Installation Guide

## Prerequisites

- PHP 8.2 or higher
- MySQL 8.0 or higher
- Composer
- Node.js & NPM
- XAMPP (or similar local server)

## Installation Steps

### 1. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 2. Environment Configuration

```bash
# Copy environment file
copy .env.example .env

# Generate application key
php artisan key:generate
```

### 3. Database Setup

Edit `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=propertyng2
DB_USERNAME=root
DB_PASSWORD=
```

Create the database in MySQL:

```sql
CREATE DATABASE propertyng2;
```

### 4. Run Migrations and Seeders

```bash
# Run migrations
php artisan migrate

# Seed the database with sample data
php artisan db:seed
```

### 5. Storage Link

```bash
# Create symbolic link for storage
php artisan storage:link
```

### 6. Build Frontend Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 7. Start Development Server

```bash
php artisan serve
```

Visit: http://localhost:8000

## Default Login Credentials

After seeding, you can login with:

- **Admin**: admin@property.com.ng / password
- **Agent**: agent@property.com.ng / password
- **Landlord**: landlord@property.com.ng / password
- **Developer**: developer@property.com.ng / password

## File Permissions

Ensure these directories are writable:

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

## Troubleshooting

### Issue: Class not found

```bash
composer dump-autoload
```

### Issue: Permission denied

```bash
# On Linux/Mac
sudo chmod -R 777 storage bootstrap/cache

# On Windows (run as administrator)
icacls storage /grant Users:F /t
icacls bootstrap\cache /grant Users:F /t
```

### Issue: Vite not working

```bash
npm install
npm run dev
```

## Production Deployment

1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false` in `.env`
3. Run `php artisan config:cache`
4. Run `php artisan route:cache`
5. Run `php artisan view:cache`
6. Run `npm run build`

## Additional Configuration

### Mail Configuration

Update `.env` with your mail settings:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@propertyng.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### Payment Gateway (Optional)

To integrate Paystack or Flutterwave, add to `.env`:

```env
PAYSTACK_PUBLIC_KEY=your_public_key
PAYSTACK_SECRET_KEY=your_secret_key
```

## Support

For issues or questions, please contact: support@propertyng.com
