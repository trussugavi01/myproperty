# Property Listing Platform

A comprehensive multi-role property listing system built with Laravel 11.

## Tech Stack

- **Backend**: Laravel 11, PHP 8.2+, MySQL 8
- **Frontend**: Blade Templates, Bootstrap 5, Vanilla JS, Alpine.js
- **Build Tools**: Vite
- **Authentication**: Laravel Breeze

## Features

- Multi-role system (Agent, Landlord/JV Partner, Developer, Admin)
- Property listing management with image galleries
- Advanced search and filtering
- Inquiry and messaging system
- Subscription plans and premium listings
- Admin panel with analytics and reporting
- Role-based dashboards
- Email notifications

## Installation

1. Clone the repository
2. Copy `.env.example` to `.env` and configure your database
3. Run `composer install`
4. Run `php artisan key:generate`
5. Run `php artisan migrate --seed`
6. Run `npm install && npm run dev`
7. Run `php artisan storage:link`
8. Start the server: `php artisan serve`

## User Roles

- **Agent**: Manage property listings and inquiries
- **Landlord/JV Partner**: Create listings for owned properties
- **Developer**: Manage development projects and sales
- **Admin**: Full system control, approvals, and analytics

## Default Users (After Seeding)

- Admin: admin@property.com.ng / password
- Agent: agent@property.com.ng / password
- Landlord: landlord@property.com.ng / password
- Developer: developer@property.com.ng / password

## License

Proprietary - All Rights Reserved
