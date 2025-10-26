# Quick Start Guide

Get your CakePHP Hexagonal Architecture project up and running in minutes!

## 🚀 Installation Steps

### 1. Install Dependencies

```bash
composer install
```

This will install:
- CakePHP 5.x
- Required dependencies
- Development tools (PHPUnit, Debug Kit, etc.)

### 2. Configure Database

Copy the example configuration:

```bash
cp config/app_local.example.php config/app_local.php
```

Edit `config/app_local.php` and update the database settings:

```php
'Datasources' => [
    'default' => [
        'host' => 'localhost',
        'username' => 'your_db_user',
        'password' => 'your_db_password',
        'database' => 'your_database_name',
    ],
],
```

### 3. Create Database

Create your database:

```bash
# MySQL
mysql -u root -p -e "CREATE DATABASE your_database_name CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Or use your preferred database management tool
```

### 4. Run Migrations

```bash
bin/cake migrations migrate
```

This will create the `users` table.

### 5. Start Development Server

```bash
bin/cake server
```

Or specify a custom port:

```bash
bin/cake server -p 8080
```

### 6. Open Your Browser

Navigate to:
```
http://localhost:8765
```

## 🎯 What to Explore

### Home Page
- Overview of the architecture
- Quick links to features
- Visual representation of layers

### Users Section
- **List Users**: `/users/index` - See all users
- **Add User**: `/users/add` - Create a new user
- **View User**: `/users/view/1` - View user details
- **Dashboard**: `/users/dashboard` - Example dashboard

### About Page
- `/pages/display/about` - Learn about hexagonal architecture

## 📝 Creating Your First User

1. Navigate to `/users/add`
2. Fill in the form:
   - **Name**: John Doe
   - **Email**: john@example.com
3. Click "Save User"
4. You'll be redirected to the users list

## 🧪 Running Tests

```bash
# Run all tests
composer test

# Run with coverage
vendor/bin/phpunit --coverage-html coverage/

# Check code style
composer cs-check

# Fix code style
composer cs-fix
```

## 🔧 Common Commands

```bash
# Clear cache
bin/cake cache clear_all

# List all routes
bin/cake routes

# Create a new migration
bin/cake bake migration CreateProducts

# Run a specific migration
bin/cake migrations migrate --target=20241023000000

# Rollback migrations
bin/cake migrations rollback
```

## 📂 Project Structure Overview

```
skeleton-cakephp/
├── src/
│   ├── Domain/              # Business logic (framework-independent)
│   ├── Application/         # Use cases
│   ├── Infrastructure/      # Framework adapters
│   └── Controller/          # HTTP controllers
├── templates/               # Views (AdminLTE)
├── config/                  # Configuration
├── webroot/                 # Public files
└── tests/                   # Tests
```

## 🎨 AdminLTE Features

The project includes AdminLTE 3 with:
- Responsive sidebar navigation
- Dashboard widgets
- Beautiful forms and tables
- Icons from Font Awesome
- Modern UI components

## 🐛 Troubleshooting

### Database Connection Error
- Check your database credentials in `config/app_local.php`
- Ensure MySQL/PostgreSQL is running
- Verify the database exists

### Permission Errors
```bash
# Make sure tmp and logs directories are writable
chmod -R 777 tmp logs
```

### Composer Issues
```bash
# Clear composer cache
composer clear-cache

# Update dependencies
composer update
```

### Migration Errors
```bash
# Check migration status
bin/cake migrations status

# Reset and re-run migrations
bin/cake migrations rollback --target=0
bin/cake migrations migrate
```

## 📚 Next Steps

1. **Read the Documentation**
   - `README.md` - Full project documentation
   - `ARCHITECTURE.md` - Architecture deep dive

2. **Explore the Code**
   - Check out `src/Domain/User/Entity/User.php` - Domain entity
   - Review `src/Application/UseCases/` - Use cases
   - See `src/Infrastructure/Persistence/` - Repository implementation

3. **Create Your Own Feature**
   - Follow the pattern in the Users example
   - Create domain entities first
   - Define repository interfaces
   - Implement use cases
   - Build adapters
   - Register in DI container

4. **Customize AdminLTE**
   - Edit `templates/layout/default.php`
   - Add your own menu items
   - Customize colors and branding

## 💡 Tips

- **Keep domain pure**: No framework code in `src/Domain/`
- **Use dependency injection**: Let the container resolve dependencies
- **Write tests**: Test each layer independently
- **Follow SOLID principles**: Keep classes focused and maintainable
- **Use value objects**: For complex domain concepts

## 🤝 Need Help?

- Check the documentation files
- Review the example User implementation
- Look at CakePHP 5 documentation: https://book.cakephp.org/5/
- AdminLTE docs: https://adminlte.io/docs/

---

**Happy Coding! 🎉**
