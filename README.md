# Admin Portal

Admin portal built with Laravel 12 that allows management of customers, invoices, and custom fields.

## Features

- **Authentication**: Login system with username and password
- **Customer Management**: Create, read, update customers.
- **Invoice Management**: Create, read, update invoices
- **Custom Fields**: Configure custom fields for both Customer and Invoice 
- **API Endpoints**: Single API endpoints for listing and creating both customers and invoices

## Requirements

- PHP 8.2 or higher
- Composer
- SQLite (default) or MySQL

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/jebin-jose/admin-portal.git
   cd admin-portal
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup**
   ```bash
   # Create SQLite database (default)
   touch database/database.sqlite
   
   # Run migrations
   php artisan migrate
   
   # Seed admin user and sample data
   php artisan db:seed --class=AdminUserSeeder
   php artisan db:seed --class=SampleDataSeeder
   ```

6. **Start the development server**
   ```bash
   php artisan serve
   ```

## Usage

1. **Login**
   - Navigate to `http://localhost:8000/login`
   - Username: `admin@admin.com`
   - Password: `admin123`

2. **Dashboard**
   - After login, you'll be redirected to the admin dashboard

3. **Customer Management**
   - View all customers in the Customers section
   - Add new customers with required Name field
   - Edit existing customer information

4. **Invoice Management**
   - View all invoices in the Invoices section
   - Create new invoices by selecting a customer
   - Edit invoice details

5. **Custom Fields**
   - Configure custom fields for Customer and Invoice modules
   - Support for Text, Date, Decimal, Dropdown, and Lookup fields
   - Dropdown fields allow multiple options
   - Lookup fields can reference other modules

## Database Schema

### Users Table
- id (Primary Key)
- name (Username)
- email
- password
- timestamps

### Customers Table
- id (Primary Key)
- name (Required)
- phone
- email
- address
- timestamps

### Invoices Table
- id (Primary Key)
- customer_id (Foreign Key)
- date
- amount (Decimal)
- status (Enum: unpaid, paid, cancelled)
- timestamps

### Custom Fields Table
- id (Primary Key)
- module (Enum: customer, invoice)
- name
- type (Enum: text, date, decimal, dropdown, lookup)
- options (JSON)
- is_required (Boolean)
- lookup_module
- timestamps

## Technology Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Bootstrap 5, jQuery
- **Database**: SQLite (default) / MySQL
- **Authentication**: Laravel's built-in Auth

