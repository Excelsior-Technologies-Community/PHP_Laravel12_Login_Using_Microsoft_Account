# PHP_Laravel12_Login_Using_Microsoft_Account

## Project Overview

A complete Laravel 12 application with Microsoft OAuth2 authentication integration. This project demonstrates how to implement Single Sign-On (SSO) using Microsoft accounts with a clean and simple structure suitable for learning, interviews, and real-world use.

---

## Features

* Microsoft OAuth2 authentication
* User registration and profile synchronization
* Session-based login and logout
* Dashboard displaying user information
* Error handling and validation
* Clean MVC architecture

---

## Prerequisites

### System Requirements

* PHP 8.1 or higher
* Composer 2.0 or higher
* Laravel 12
* MySQL 5.7+ or MariaDB 10.3+
* Node.js (optional, for frontend assets)
* Git

### Required PHP Extensions

* BCMath
* Ctype
* cURL
* DOM
* Fileinfo
* JSON
* Mbstring
* OpenSSL
* PCRE
* PDO
* Tokenizer
* XML

---

## Installation Guide

### Step 1: Clone the Repository

```bash
git clone https://github.com/yourusername/laravel-microsoft-login.git
cd laravel-microsoft-login
```

### Step 2: Install PHP Dependencies

```bash
composer install
```

### Step 3: Configure Environment

```bash
cp .env.example .env
php artisan key:generate
```

### Step 4: Database Setup

Create a database:

```sql
CREATE DATABASE microsoft_login CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Update `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=microsoft_login
DB_USERNAME=root
DB_PASSWORD=your_password
```

Run migrations:

```bash
php artisan migrate
```

---

## Microsoft Azure App Registration

### 1. Register Application

* Go to Azure Portal
* Azure Active Directory → App registrations → New registration

Application details:

* Name: Laravel Microsoft Login
* Supported account types: Accounts in any organizational directory and personal Microsoft accounts
* Redirect URI (Web):

  * [http://localhost:8000/auth/microsoft/callback](http://localhost:8000/auth/microsoft/callback)

### 2. Create Client Secret

* Go to Certificates & secrets
* New client secret
* Copy secret value immediately

### 3. Authentication Configuration

Add redirect URIs:

* [http://localhost:8000/auth/microsoft/callback](http://localhost:8000/auth/microsoft/callback)
* [https://yourdomain.com/auth/microsoft/callback](https://yourdomain.com/auth/microsoft/callback)

Enable ID tokens

### 4. API Permissions

Add delegated permissions from Microsoft Graph:

* email
* offline_access
* openid
* profile
* User.Read

Grant admin consent

---

## Laravel Configuration

Update `.env`:

```env
MICROSOFT_CLIENT_ID=your-client-id
MICROSOFT_CLIENT_SECRET=your-client-secret
MICROSOFT_REDIRECT_URI=http://localhost:8000/auth/microsoft/callback
MICROSOFT_TENANT_ID=common
```

### config/services.php

```php
'microsoft' => [
    'client_id' => env('MICROSOFT_CLIENT_ID'),
    'client_secret' => env('MICROSOFT_CLIENT_SECRET'),
    'redirect' => env('MICROSOFT_REDIRECT_URI'),
    'tenant' => env('MICROSOFT_TENANT_ID', 'common'),
],
```

---

## Database Changes

### User Table Updates

```php
Schema::table('users', function (Blueprint $table) {
    $table->string('microsoft_id')->nullable()->unique();
    $table->string('avatar')->nullable();
    $table->timestamp('last_login_at')->nullable();
    $table->string('timezone')->nullable();
});
```

### User Model

```php
protected $fillable = [
    'name',
    'email',
    'password',
    'microsoft_id',
    'avatar',
    'timezone',
    'last_login_at'
];
```

---

## Routes

| Method | URI                      | Action          | Middleware |
| ------ | ------------------------ | --------------- | ---------- |
| GET    | /                        | Welcome Page    | guest      |
| GET    | /auth/microsoft          | Microsoft Login | guest      |
| GET    | /auth/microsoft/callback | OAuth Callback  | guest      |
| GET    | /dashboard               | User Dashboard  | auth       |
| POST   | /logout                  | Logout          | auth       |

---

## Project Structure

```
laravel-microsoft-login/
├── app/
│   ├── Http/Controllers/Auth/MicrosoftAuthController.php
│   ├── Models/User.php
├── config/services.php
├── database/migrations/
├── resources/views/
│   ├── welcome.blade.php
│   └── dashboard.blade.php
├── routes/web.php
├── .env.example
└── composer.json
```

---

## Run Application

```bash
php artisan serve
```

Visit:

```
http://localhost:8000
```

---

## Future Enhancements

* Role-based access control
* Microsoft Graph advanced profile sync
* Multi-provider login (Google, GitHub)
* API-based authentication
* Deployment configuration

---

## Author

Mihir Mehta

Laravel 12 Microsoft OAuth2 Authentication Project
