# AJK Bar Council - Member Directory System

<p align="center">
    <img src="public/icons-images/logo.jpg" width="200" alt="AJK Bar Council Logo">
</p>

A comprehensive web-based management system for the Azad Jammu and Kashmir Bar Council to manage bar associations, advocates, and provide a public search directory.

## 🎯 Features

### Public Features
- **Public Advocate Search**: Google-style search interface for finding advocates
- **Advanced Search**: Filter by name, mobile number, email, bar association, and father's name
- **Advocate Profiles**: Detailed public profiles with contact information and enrollment dates

### Admin Features
- **Bar Association Management**: Create, read, update, delete (CRUD) bar associations
- **Advocate Management**: Full CRUD operations for advocate records
- **User Management**: Role-based access control with Laravel Jetstream
- **Activity Logging**: Track all changes with Spatie Activity Log
- **Soft Deletes**: Safe deletion with restore capabilities
- **Dashboard**: Statistics and quick access to key metrics
- **Two-Factor Authentication**: Enhanced security for user accounts

## 🛠️ Technology Stack

- **Framework**: Laravel 12.x
- **PHP**: 8.2+
- **Authentication**: Laravel Jetstream with Livewire
- **Frontend**: Tailwind CSS 3.x
- **Database**: MySQL/PostgreSQL/SQLite
- **Testing**: Pest PHP
- **Build Tool**: Vite

### Key Dependencies
- **laravel/jetstream**: Authentication scaffolding with teams support
- **spatie/laravel-activitylog**: Activity logging
- **spatie/laravel-permission**: Role and permission management
- **spatie/laravel-query-builder**: Advanced query filtering
- **livewire/livewire**: Dynamic frontend components

## 📋 Requirements

- PHP 8.2 or higher
- Composer 2.x
- Node.js 18.x or higher
- NPM 9.x or higher
- MySQL 8.0+ / PostgreSQL 13+ / SQLite 3.x

## 🚀 Installation

### 1. Clone the Repository
```bash
git clone https://github.com/alimarchal/ajkbarcouncil-orignal.git
cd ajkbarcouncil
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Configuration
```bash
# Copy the example environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Configuration
Edit your `.env` file and configure your database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ajkbarcouncil
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Run Migrations and Seed Database
```bash
# Fresh migration with seeders (WARNING: This will drop all tables!)
php artisan migrate:fresh --seed
```

This will create:
- Users table with authentication
- Bar Associations table
- Advocates table
- Activity logs
- Permission and role tables
- Sample data for testing

### 6. Build Frontend Assets
```bash
# For development
npm run dev

# For production
npm run build
```

### 7. Start the Development Server
```bash
# Using Laravel's built-in server
php artisan serve

# Or use Laravel Herd (macOS)
# Access at: https://ajkbarcouncil.test
```

## 🧪 Testing

The project includes comprehensive tests using Pest PHP.

```bash
# Run all tests
php artisan test

# Run with coverage
php artisan test --coverage

# Run specific test suite
php artisan test --testsuite=Feature

# Run specific test file
php artisan test tests/Feature/AdvocateTest.php
```

### Test Coverage
- ✅ Advocate CRUD operations (29 tests)
- ✅ Bar Association CRUD operations (23 tests)
- ✅ Authentication and Authorization (7 tests)
- ✅ User Profile Management (8 tests)
- ✅ Password Management (7 tests)
- ✅ Two-Factor Authentication (3 tests)

**Total**: 77 passing tests with 175 assertions

## 📁 Project Structure

```
ajkbarcouncil/
├── app/
│   ├── Actions/          # Jetstream actions
│   ├── Helpers/          # Helper classes (FileStorageHelper)
│   ├── Http/
│   │   ├── Controllers/  # Application controllers
│   │   └── Requests/     # Form request validations
│   ├── Models/           # Eloquent models
│   ├── Policies/         # Authorization policies
│   └── Traits/           # Reusable traits (UserTracking)
├── database/
│   ├── factories/        # Model factories
│   ├── migrations/       # Database migrations
│   └── seeders/          # Database seeders
├── public/
│   └── icons-images/     # Public assets and logos
├── resources/
│   ├── css/             # Stylesheets
│   ├── js/              # JavaScript files
│   └── views/           # Blade templates
│       ├── advocates/   # Advocate management views
│       ├── bar-associations/ # Bar association views
│       ├── public/      # Public-facing views
│       └── auth/        # Authentication views
├── routes/
│   ├── web.php          # Web routes
│   └── api.php          # API routes
└── tests/
    ├── Feature/         # Feature tests
    └── Unit/            # Unit tests
```

## 🔐 Default Login Credentials

After running `php artisan migrate:fresh --seed`, you can login with:

```
Email: admin@example.com
Password: password
```

> ⚠️ **Important**: Change default credentials in production!

## 📊 Database Schema

### Bar Associations
- id, name, address, phone
- is_active (status)
- created_by, updated_by (user tracking)
- timestamps, soft deletes

### Advocates
- id, name, father_husband_name
- bar_association_id (foreign key)
- permanent_member_of_bar_association
- mobile_no, email_address
- date_of_enrolment_lower_courts
- date_of_enrolment_high_court
- date_of_enrolment_supreme_court
- is_active (status)
- created_by, updated_by (user tracking)
- timestamps, soft deletes

## 🌐 Routes

### Public Routes
- `GET /` - Home (redirects to public advocates)
- `GET /public/advocates` - Public advocate search
- `GET /public/advocates/{id}` - Advocate public profile

### Authenticated Routes
- `GET /dashboard` - Admin dashboard
- `Resource /bar-associations` - Bar association CRUD
- `PATCH /bar-associations/{id}/restore` - Restore deleted association
- `Resource /advocates` - Advocate CRUD
- `PATCH /advocates/{id}/restore` - Restore deleted advocate
- `GET /advocates/report` - Advocate reports

## 🎨 Features in Detail

### Public Search Page
- Google-style search interface
- Real-time search with filters
- Advanced search options
- Pagination
- Responsive design (mobile-friendly)

### Dashboard
- Total bar associations count
- Total advocates count
- Total users count
- Active vs inactive statistics
- Quick action cards

### User Tracking
All records automatically track:
- Who created the record
- Who last updated the record
- When it was created/updated
- Activity logs for audit trail

## 🔧 Configuration

### File Storage
The system uses a custom `FileStorageHelper` for managing file uploads. Configure storage in `config/filesystems.php`.

### Activity Logging
Activity logs are automatically captured for all models. View logs in the database `activity_log` table.

## 🚀 Deployment

### Production Checklist
1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false`
3. Run `php artisan config:cache`
4. Run `php artisan route:cache`
5. Run `php artisan view:cache`
6. Run `npm run build`
7. Set proper file permissions
8. Configure proper database credentials
9. Set up SSL certificate
10. Configure proper backup strategy

### Optimization
```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev
```

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License.

## 👥 Support

For support, email [kh.marchal@gmail.com](mailto:kh.marchal@gmail.com)

## 🔄 Version History

### Version 1.0.0 (October 2025)
- Initial release
- Bar Association management
- Advocate management
- Public search interface
- User authentication with Jetstream
- Activity logging
- Comprehensive test suite

---

**Developed for**: Azad Jammu and Kashmir Bar Council  
**Developed by**: SeeChange Innovative Pvt Ltd & MOON CREATIONS  
**Repository**: https://github.com/alimarchal/ajkbarcouncil-orignal
