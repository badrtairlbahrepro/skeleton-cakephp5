# CakePHP Skeleton with Hexagonal Architecture & DDD

A modern CakePHP 5 skeleton application implementing **Hexagonal Architecture** (Ports & Adapters), **Domain-Driven Design (DDD)**, **Automatic Dependency Injection**, and **AdminLTE** for a beautiful admin interface.

## 🏗️ Architecture

This project follows **Clean Architecture** principles with three main layers:

### 1. **Domain Layer** (`src/Domain/`)
- Contains pure business logic
- Framework-independent entities
- Repository interfaces (ports)
- No dependencies on infrastructure or framework

```
src/Domain/
├── User/
│   ├── Entity/
│   │   └── User.php              # Rich domain entity with business rules
│   └── Repository/
│       └── UserRepositoryInterface.php  # Port definition
```

### 2. **Application Layer** (`src/Application/`)
- Use cases orchestrating business logic
- Application services
- Independent of infrastructure details

```
src/Application/
└── UseCases/
    └── User/
        ├── CreateUserUseCase.php  # Business use case
        └── GetUserUseCase.php     # Query use case
```

### 3. **Infrastructure Layer** (`src/Infrastructure/`)
- Framework-specific implementations
- Database adapters (CakePHP ORM)
- External service integrations
- Dependency injection configuration

```
src/Infrastructure/
├── DependencyInjection/
│   └── ServiceProvider.php       # DI container configuration
└── Persistence/
    └── CakeOrm/
        ├── UserRepository.php    # Adapter implementation
        └── Table/
            └── UsersTable.php    # CakePHP ORM table
```

## ✨ Features

- ✅ **Hexagonal Architecture** - Clean separation of concerns
- ✅ **Domain-Driven Design** - Rich domain models with business logic
- ✅ **Automatic Dependency Injection** - Using CakePHP 5's DI container
- ✅ **AdminLTE 3** - Modern, responsive admin interface
- ✅ **SOLID Principles** - Maintainable and testable code
- ✅ **Repository Pattern** - Abstract data access
- ✅ **Use Case Pattern** - Clear business logic organization

## 🚀 Quick Start

### Prerequisites

- PHP 8.1 or higher
- Composer
- MySQL/MariaDB or PostgreSQL
- Web server (Apache/Nginx) or use built-in PHP server

### Installation

1. **Install dependencies:**
```bash
composer install
```

2. **Configure database:**
```bash
cp config/app_local.example.php config/app_local.php
```

Edit `config/app_local.php` and update the database configuration:
```php
'Datasources' => [
    'default' => [
        'host' => 'localhost',
        'username' => 'your_username',
        'password' => 'your_password',
        'database' => 'your_database',
    ],
],
```

3. **Run migrations:**
```bash
bin/cake migrations migrate
```

4. **Start the development server:**
```bash
bin/cake server
```

5. **Open your browser:**
```
http://localhost:8765
```

## 📁 Project Structure

```
skeleton-cakephp/
├── bin/                          # Executable scripts
│   └── cake                      # CakePHP console
├── config/                       # Configuration files
│   ├── app.php                   # Main configuration
│   ├── app_local.php             # Local configuration (gitignored)
│   ├── bootstrap.php             # Bootstrap logic
│   ├── routes.php                # Route definitions
│   └── Migrations/               # Database migrations
├── src/
│   ├── Application.php           # Application class with DI setup
│   ├── Controller/               # Controllers (Presentation layer)
│   ├── View/                     # View classes
│   ├── Domain/                   # 🔷 Domain layer (Business logic)
│   │   └── User/
│   │       ├── Entity/
│   │       └── Repository/
│   ├── Application/              # 🔶 Application layer (Use cases)
│   │   └── UseCases/
│   └── Infrastructure/           # 🔸 Infrastructure layer (Adapters)
│       ├── DependencyInjection/
│       └── Persistence/
├── templates/                    # View templates
│   ├── layout/
│   │   └── default.php          # AdminLTE layout
│   ├── Pages/
│   │   └── home.php             # Home page
│   └── Users/                   # User CRUD views
├── webroot/                     # Public directory
│   └── index.php                # Entry point
├── tests/                       # Test files
├── composer.json                # Dependencies
└── README.md                    # This file
```

## 🎯 Dependency Injection

The project uses **automatic dependency injection** via CakePHP's DI container. Services are automatically resolved and injected into controllers.

### Example: Controller with DI

```php
class UsersController extends AppController
{
    // Use case is automatically injected
    public function index(GetUserUseCase $getUserUseCase): void
    {
        $users = $getUserUseCase->getAll();
        $this->set(compact('users'));
    }
}
```

### Registering Services

Services are registered in `src/Infrastructure/DependencyInjection/ServiceProvider.php`:

```php
public function register(ContainerInterface $container): void
{
    // Register repository interface to implementation
    $container->add(UserRepositoryInterface::class, UserRepository::class);
    
    // Register use cases with dependencies
    $container->add(CreateUserUseCase::class)
        ->addArgument(UserRepositoryInterface::class);
}
```

## 🎨 AdminLTE Integration

The project includes **AdminLTE 3**, a modern admin dashboard template:

- Responsive sidebar navigation
- Beautiful UI components
- Dashboard widgets
- Form styling
- Table layouts

All templates use the AdminLTE layout located at `templates/layout/default.php`.

## 📝 Creating New Features

### 1. Create Domain Entity

```php
// src/Domain/Product/Entity/Product.php
namespace Domain\Product\Entity;

class Product
{
    private ?int $id;
    private string $name;
    private float $price;
    
    // Business logic and validation
}
```

### 2. Create Repository Interface

```php
// src/Domain/Product/Repository/ProductRepositoryInterface.php
namespace Domain\Product\Repository;

interface ProductRepositoryInterface
{
    public function findById(int $id): ?Product;
    public function save(Product $product): Product;
}
```

### 3. Create Use Case

```php
// src/Application/UseCases/Product/CreateProductUseCase.php
namespace Application\UseCases\Product;

class CreateProductUseCase
{
    public function __construct(
        private ProductRepositoryInterface $repository
    ) {}
    
    public function execute(string $name, float $price): Product
    {
        $product = new Product($name, $price);
        return $this->repository->save($product);
    }
}
```

### 4. Implement Repository

```php
// src/Infrastructure/Persistence/CakeOrm/ProductRepository.php
namespace Infrastructure\Persistence\CakeOrm;

class ProductRepository implements ProductRepositoryInterface
{
    // CakePHP ORM implementation
}
```

### 5. Register in DI Container

```php
// src/Infrastructure/DependencyInjection/ServiceProvider.php
$container->add(ProductRepositoryInterface::class, ProductRepository::class);
$container->add(CreateProductUseCase::class)
    ->addArgument(ProductRepositoryInterface::class);
```

### 6. Create Controller

```php
// src/Controller/ProductsController.php
class ProductsController extends AppController
{
    public function add(CreateProductUseCase $useCase)
    {
        // Automatic DI injection
    }
}
```

## 🧪 Testing

Run tests with PHPUnit:

```bash
composer test
```

Run code sniffer:

```bash
composer cs-check
```

Fix code style:

```bash
composer cs-fix
```

## 📚 Resources

- [CakePHP Documentation](https://book.cakephp.org/5/)
- [AdminLTE Documentation](https://adminlte.io/docs/)
- [Hexagonal Architecture](https://alistair.cockburn.us/hexagonal-architecture/)
- [Domain-Driven Design](https://martinfowler.com/bliki/DomainDrivenDesign.html)

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🎓 Learning Path

1. **Start with the home page** - See the architecture overview
2. **Explore Users CRUD** - Understand the full flow from controller to domain
3. **Check the code** - Review how DI and hexagonal architecture work together
4. **Create your own feature** - Follow the patterns established

## 💡 Key Benefits

- **Testability**: Business logic is independent of framework
- **Maintainability**: Clear separation of concerns
- **Flexibility**: Easy to swap implementations (e.g., change ORM)
- **Scalability**: Well-organized code that grows with your application
- **Team Collaboration**: Clear boundaries between layers

---

**Happy Coding! 🚀**
