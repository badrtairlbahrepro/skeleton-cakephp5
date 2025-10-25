# Architecture Documentation

## Hexagonal Architecture (Ports & Adapters)

This project implements **Hexagonal Architecture**, also known as **Ports and Adapters**, combined with **Domain-Driven Design (DDD)** principles.

## Core Principles

### 1. Dependency Rule
Dependencies point inward. The domain layer has no dependencies on outer layers.

```
Infrastructure → Application → Domain
     ↓               ↓            ↓
  Adapters      Use Cases    Business Logic
```

### 2. Layers

#### Domain Layer (Inner Circle)
**Location:** `src/Domain/`

**Purpose:** Contains pure business logic, independent of any framework or infrastructure.

**Components:**
- **Entities**: Rich domain objects with business logic and validation
- **Value Objects**: Immutable objects representing domain concepts
- **Repository Interfaces (Ports)**: Define contracts for data access
- **Domain Services**: Complex business logic that doesn't fit in entities

**Rules:**
- ✅ No framework dependencies
- ✅ No infrastructure dependencies
- ✅ Pure PHP business logic
- ✅ Framework-agnostic

**Example:**
```php
// src/Domain/User/Entity/User.php
class User
{
    private string $email;
    private string $name;
    
    public function __construct(string $email, string $name)
    {
        $this->validateEmail($email);
        $this->email = $email;
        $this->name = $name;
    }
    
    private function validateEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid email');
        }
    }
}
```

#### Application Layer (Middle Circle)
**Location:** `src/Application/`

**Purpose:** Orchestrates business logic through use cases. Contains application-specific business rules.

**Components:**
- **Use Cases**: Application-specific business logic
- **Application Services**: Coordinate multiple use cases
- **DTOs**: Data Transfer Objects for communication between layers

**Rules:**
- ✅ Depends on Domain layer
- ✅ Independent of Infrastructure
- ✅ No framework-specific code
- ✅ Orchestrates domain entities

**Example:**
```php
// src/Application/UseCases/User/CreateUserUseCase.php
class CreateUserUseCase
{
    public function __construct(
        private UserRepositoryInterface $repository
    ) {}
    
    public function execute(string $email, string $name): User
    {
        // Check business rules
        if ($this->repository->findByEmail($email)) {
            throw new \RuntimeException('User already exists');
        }
        
        // Create domain entity
        $user = new User($email, $name);
        
        // Persist through port
        return $this->repository->save($user);
    }
}
```

#### Infrastructure Layer (Outer Circle)
**Location:** `src/Infrastructure/`

**Purpose:** Provides concrete implementations of ports defined in inner layers. Handles external concerns.

**Components:**
- **Repository Implementations (Adapters)**: Concrete implementations using CakePHP ORM
- **External Services**: API clients, file systems, etc.
- **Framework Integration**: CakePHP-specific code
- **Dependency Injection Configuration**: Service registration

**Rules:**
- ✅ Implements interfaces from Domain/Application
- ✅ Contains framework-specific code
- ✅ Handles external dependencies
- ✅ Can be replaced without affecting business logic

**Example:**
```php
// src/Infrastructure/Persistence/CakeOrm/UserRepository.php
class UserRepository implements UserRepositoryInterface
{
    private UsersTable $table;
    
    public function save(User $user): User
    {
        // Adapt domain entity to CakePHP entity
        $entity = $this->table->newEntity([
            'email' => $user->getEmail(),
            'name' => $user->getName(),
        ]);
        
        $this->table->saveOrFail($entity);
        
        // Convert back to domain entity
        return $this->toDomainEntity($entity);
    }
}
```

## Dependency Injection

### Automatic DI with CakePHP 5

The project uses CakePHP 5's built-in dependency injection container for automatic service resolution.

### Configuration

Services are registered in `src/Infrastructure/DependencyInjection/ServiceProvider.php`:

```php
public function register(ContainerInterface $container): void
{
    // Register interface to implementation binding
    $container->add(UserRepositoryInterface::class, UserRepository::class);
    
    // Register use case with dependencies
    $container->add(CreateUserUseCase::class)
        ->addArgument(UserRepositoryInterface::class);
}
```

### Controller Injection

Controllers receive dependencies automatically through method parameters:

```php
class UsersController extends AppController
{
    // Automatic injection via method parameter
    public function index(GetUserUseCase $getUserUseCase): void
    {
        $users = $getUserUseCase->getAll();
        $this->set(compact('users'));
    }
}
```

## Data Flow

### Request Flow (Write Operation)

```
1. HTTP Request
   ↓
2. Controller (Presentation Layer)
   ↓
3. Use Case (Application Layer)
   ↓
4. Domain Entity (Domain Layer)
   ↓
5. Repository Interface (Domain Port)
   ↓
6. Repository Implementation (Infrastructure Adapter)
   ↓
7. Database (External)
```

### Example: Creating a User

```php
// 1. HTTP POST to /users/add

// 2. Controller receives request
public function add(CreateUserUseCase $createUser)
{
    $data = $this->request->getData();
    
    // 3. Execute use case
    $user = $createUser->execute($data['email'], $data['name']);
}

// 4. Use case creates domain entity
public function execute(string $email, string $name): User
{
    $user = new User($email, $name); // Domain validation
    
    // 5. Use repository port
    return $this->repository->save($user);
}

// 6. Repository adapter implements port
public function save(User $user): User
{
    // Convert domain entity to ORM entity
    $entity = $this->table->newEntity([...]);
    
    // 7. Persist to database
    $this->table->saveOrFail($entity);
    
    return $this->toDomainEntity($entity);
}
```

## Benefits

### 1. Testability
- Domain logic can be tested without framework
- Use cases can be tested with mock repositories
- Each layer can be tested independently

### 2. Maintainability
- Clear separation of concerns
- Changes in one layer don't affect others
- Easy to understand and navigate

### 3. Flexibility
- Can swap ORM (e.g., Doctrine, Eloquent) without changing domain
- Can change frameworks without rewriting business logic
- Easy to add new adapters (REST API, GraphQL, CLI)

### 4. Independence
- Business logic is framework-agnostic
- Domain entities are pure PHP
- No vendor lock-in

## Testing Strategy

### Unit Tests
Test domain entities and use cases in isolation:

```php
class UserTest extends TestCase
{
    public function testValidation()
    {
        $this->expectException(\InvalidArgumentException::class);
        new User('invalid-email', 'John');
    }
}
```

### Integration Tests
Test repository implementations with real database:

```php
class UserRepositoryTest extends TestCase
{
    public function testSave()
    {
        $user = new User('test@example.com', 'Test User');
        $saved = $this->repository->save($user);
        
        $this->assertNotNull($saved->getId());
    }
}
```

### Functional Tests
Test the full stack through controllers:

```php
class UsersControllerTest extends IntegrationTestCase
{
    public function testAdd()
    {
        $this->post('/users/add', [
            'email' => 'test@example.com',
            'name' => 'Test User'
        ]);
        
        $this->assertResponseSuccess();
    }
}
```

## Adding New Features

### Step-by-Step Guide

1. **Define Domain Entity** (Domain Layer)
   - Create entity with business logic
   - Add validation rules
   - Keep it framework-independent

2. **Define Repository Interface** (Domain Layer)
   - Define the contract (port)
   - Specify required methods

3. **Create Use Case** (Application Layer)
   - Orchestrate business logic
   - Use repository interface
   - Handle application rules

4. **Implement Repository** (Infrastructure Layer)
   - Create CakePHP ORM adapter
   - Implement the interface
   - Handle data conversion

5. **Register in DI Container** (Infrastructure Layer)
   - Add to ServiceProvider
   - Configure dependencies

6. **Create Controller** (Presentation Layer)
   - Inject use case
   - Handle HTTP concerns
   - Return responses

7. **Create Views** (Presentation Layer)
   - Use AdminLTE components
   - Display data

## Best Practices

### DO ✅
- Keep domain entities pure and framework-independent
- Use interfaces for all repository contracts
- Inject dependencies through constructor
- Validate in domain entities
- Use value objects for complex types
- Write tests for each layer

### DON'T ❌
- Don't put framework code in domain layer
- Don't access database directly from use cases
- Don't skip the repository interface
- Don't put business logic in controllers
- Don't couple domain to infrastructure
- Don't use static methods for dependencies

## Resources

- [Hexagonal Architecture by Alistair Cockburn](https://alistair.cockburn.us/hexagonal-architecture/)
- [Domain-Driven Design by Eric Evans](https://www.domainlanguage.com/ddd/)
- [Clean Architecture by Robert C. Martin](https://blog.cleancoder.com/uncle-bob/2012/08/13/the-clean-architecture.html)
- [CakePHP Dependency Injection](https://book.cakephp.org/5/en/development/dependency-injection.html)

---

**Remember:** The goal is to keep business logic independent of frameworks and infrastructure, making your application more maintainable, testable, and flexible.
