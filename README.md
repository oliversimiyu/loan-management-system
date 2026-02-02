# Loan Management System

A Laravel-based loan management application for Demulla Investment Limited microfinance institution.

## Project Overview

This is a practical assessment project that implements a complete loan management module with both backend logic and a simple user interface. The system allows authenticated users to manage customer loans with full CRUD operations, filtering, and pagination.

## Features

- **User Authentication** - Built on Laravel's authentication system
- **Loan Management** - Complete CRUD operations for loans
- **Access Control** - Users can only view and manage their own loans
- **Filtering & Pagination**:
  - Filter by loan status
  - Filter by issued date range
  - Paginated results (10 per page)
- **Validation** - Form Request classes with meaningful error messages
- **Soft Deletes** - Loans are soft deleted, not permanently removed
- **Clean UI** - Simple Blade templates with clear validation messages

## Database Schema

### Loans Table

| Column | Type | Description |
|--------|------|-------------|
| id | Primary Key | Auto-incrementing ID |
| loan_number | String (Unique) | Unique loan identifier |
| customer_name | String | Borrower's name |
| loan_amount | Decimal | Loan amount |
| interest_rate | Decimal (%) | Interest rate percentage |
| loan_term | Integer | Loan term in months |
| status | Enum | pending, approved, active, completed, defaulted |
| issued_date | Date | Date loan was issued |
| due_date | Date | Loan due date |
| user_id | Foreign Key | Staff user who created the loan |
| timestamps | Timestamps | created_at, updated_at |
| deleted_at | Timestamp | Soft delete timestamp |

## Setup Instructions

### Prerequisites

- PHP 8.2 or higher
- Composer
- MySQL or compatible database
- Node.js & NPM (for asset compilation)

### Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd loan-management-system
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database**
   
   Edit `.env` file and set your database credentials:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=loan_management
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Run migrations**
   ```bash
   php artisan migrate
   ```

6. **Create a user account**
   
   You can use tinker to create a test user:
   ```bash
   php artisan tinker
   ```
   Then run:
   ```php
   \App\Models\User::create([
       'name' => 'Test User',
       'email' => 'test@example.com',
       'password' => bcrypt('password')
   ]);
   ```

7. **Start the development server**
   ```bash
   php artisan serve
   ```

8. **Access the application**
   
   Navigate to `http://localhost:8000` in your browser.

## Usage

### Login
- Use the credentials you created during setup
- Default test credentials: `test@example.com` / `password`

### Managing Loans

1. **Create a Loan**
   - Click "Create New Loan" button
   - Fill in all required fields
   - Submit the form

2. **View Loans**
   - All your loans are listed on the main page
   - Use filters to narrow down results by status or date range

3. **View Loan Details**
   - Click "View" button on any loan
   - See complete loan information

4. **Edit a Loan**
   - Click "Edit" button on any loan
   - Update the information
   - Save changes

5. **Delete a Loan**
   - View loan details
   - Click "Delete Loan" button
   - Confirm deletion (soft delete)

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   └── LoanController.php       # Main loan CRUD controller
│   └── Requests/
│       ├── StoreLoanRequest.php     # Validation for creating loans
│       └── UpdateLoanRequest.php    # Validation for updating loans
├── Models/
│   ├── Loan.php                     # Loan model with relationships
│   └── User.php                     # User model with loan relationship
└── Policies/
    └── LoanPolicy.php               # Authorization policies

database/
└── migrations/
    └── xxxx_create_loans_table.php  # Loans table migration

resources/
└── views/
    ├── layouts/
    │   └── app.blade.php            # Main layout template
    └── loans/
        ├── index.blade.php          # Loan list with filters
        ├── create.blade.php         # Create loan form
        ├── edit.blade.php           # Edit loan form
        └── show.blade.php           # Loan details view

routes/
└── web.php                          # Route definitions
```

## Design Decisions

### Architecture
- **MVC Pattern** - Standard Laravel MVC architecture
- **Repository Pattern** - Not used; keeping it simple with Eloquent
- **Service Layer** - Not used for this simple CRUD application
- **Policy-based Authorization** - Ensures users only access their own loans

### Database
- **Soft Deletes** - Preserves data integrity and audit trail
- **Foreign Key Constraints** - Ensures referential integrity
- **Enum for Status** - Constrains valid status values at database level

### Validation
- **Form Request Classes** - Separates validation logic from controllers
- **Custom Error Messages** - Provides clear feedback to users
- **Client-side HTML5 Validation** - Basic UX improvement

### UI/UX
- **Simple CSS** - No framework dependency for easy understanding
- **Responsive Design** - Basic mobile-friendly layout
- **Clear Messaging** - Success/error messages for all operations
- **Inline Validation Errors** - Shows errors next to form fields

## Assumptions

1. User authentication is already implemented (Laravel default)
2. This is an internal tool for microfinance staff
3. Each loan is managed by one staff user
4. Loan calculations (interest, payments) are handled elsewhere
5. No role-based permissions needed beyond ownership
6. Simple pagination (10 items) is sufficient
7. No need for API endpoints (web-only application)
8. Bootstrap/Tailwind not required (assessment specifies simple styling)

## Testing

To run tests:
```bash
php artisan test
```

Note: Test coverage focuses on core functionality and is not exhaustive for this assessment.

## Future Enhancements

- Payment tracking and history
- Automated interest calculations
- Email notifications for due dates
- PDF export of loan details
- Advanced reporting and analytics
- Multi-role support (admin, manager, staff)
- API endpoints for mobile apps

## Troubleshooting

### Database Connection Issues
- Verify `.env` database credentials
- Ensure MySQL service is running
- Check database exists: `CREATE DATABASE loan_management;`

### Migration Errors
- Clear cached config: `php artisan config:clear`
- Roll back and re-run: `php artisan migrate:fresh`

### Authorization Errors
- Ensure you're logged in
- Verify you're accessing your own loans
- Check LoanPolicy is registered

## License

This project is developed as a practical assessment for Demulla Investment Limited.

---

**Developer**: Candidate Assessment Project  
**Date**: February 2, 2026  
**Organization**: Demulla Investment Limited


In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
