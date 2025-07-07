# 🔧 Railway Database Configuration Guide

## Your Database.php Configuration

Your `database.php` file is looking for these environment variables:

```php
$this->host = $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?? 'localhost';
$this->db_name = $_ENV['DB_NAME'] ?? getenv('DB_NAME') ?? 'personal_finance_tracker';
$this->username = $_ENV['DB_USER'] ?? getenv('DB_USER') ?? 'root';
$this->password = $_ENV['DB_PASSWORD'] ?? getenv('DB_PASSWORD') ?? '';
```

## Railway MySQL Variables

When you add MySQL to Railway, it creates these variables:
- `MYSQL_HOST`
- `MYSQL_DATABASE`
- `MYSQL_USER`
- `MYSQL_PASSWORD`
- `MYSQL_PORT`

## Variable Mapping

You need to set these variables in Railway to match your database.php:

### Option 1: Add Custom Variables (Recommended)
In Railway, go to your backend service → Variables and add:
```
DB_HOST = ${{ MYSQL_HOST }}
DB_NAME = ${{ MYSQL_DATABASE }}
DB_USER = ${{ MYSQL_USER }}
DB_PASSWORD = ${{ MYSQL_PASSWORD }}
```

### Option 2: Update database.php to use Railway variables
Or I can update your database.php to use Railway's default variable names.

## Which Option Do You Prefer?

**Option 1** keeps your code unchanged and just maps the variables.
**Option 2** updates your code to use Railway's default names.

Let me know which you prefer and I'll help you with the next steps!
