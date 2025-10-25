# 📚 Guide Complet des Tests Unitaires

## 📖 Table des Matières

1. [Introduction aux Tests Unitaires](#introduction-aux-tests-unitaires)
2. [Structure du Projet](#structure-du-projet)
3. [Configuration PHPUnit](#configuration-phpunit)
4. [Les Tests Existants](#les-tests-existants)
5. [Comment Écrire des Tests](#comment-écrire-des-tests)
6. [Les Mocks et Stubs](#les-mocks-et-stubs)
7. [Lancer les Tests](#lancer-les-tests)
8. [Best Practices](#best-practices)
9. [Déboguer les Tests](#déboguer-les-tests)

---

## Introduction aux Tests Unitaires

### Qu'est-ce qu'un Test Unitaire ?

Un **test unitaire** est un test automatisé qui vérifie le comportement d'une petite partie (une "unité") du code en isolation. L'objectif est de s'assurer que chaque fonction/classe fonctionne correctement.

### Avantages des Tests Unitaires

✅ **Confiance**: Vérifier que le code fonctionne comme prévu  
✅ **Régression**: Détecter les bugs après des modifications  
✅ **Documentation**: Les tests servent d'exemples d'utilisation  
✅ **Design**: Encourager une meilleure architecture  
✅ **Refactoring**: Modifier le code en toute confiance  

### Framework Utilisé: PHPUnit

```bash
PHPUnit 10.5.58 by Sebastian Bergmann
https://phpunit.de/
```

---

## Structure du Projet

### Arborescence des Tests

```
tests/
├── bootstrap.php                                    # Fichier d'amorçage
└── TestCase/
    ├── Application/
    │   └── UseCases/
    │       └── User/
    │           ├── CreateUserUseCaseTest.php       # Tests CreateUserUseCase
    │           └── GetUserUseCaseTest.php          # Tests GetUserUseCase
    └── Domain/
        └── User/
            └── Entity/
                └── UserTest.php                    # Tests Entity User
```

### Conventions de Nommage

- **Classe à tester**: `User`
- **Fichier de test**: `UserTest.php`
- **Namespace**: `Tests\TestCase\Domain\User\Entity`
- **Classe de test**: `UserTest extends TestCase`
- **Méthode de test**: `testXXX()` ou `test_xxx_function()`

```php
// ❌ Mauvais
function test() { }
function userTest() { }

// ✅ Correct
function testCreateUserWithValidData() { }
function testUserWithInvalidEmail() { }
```

---

## Configuration PHPUnit

### Fichier `phpunit.xml.dist`

```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit
    colors="true"
    processIsolation="false"
    stopOnFailure="false"
    bootstrap="tests/bootstrap.php"
    cacheDirectory=".phpunit.cache"
    backupGlobals="true"
>
    <php>
        <ini name="memory_limit" value="-1"/>
    </php>

    <testsuites>
        <testsuite name="app">
            <directory>tests/TestCase/</directory>
        </testsuite>
    </testsuites>

    <source>
        <include>
            <directory suffix=".php">src/</directory>
        </include>
    </source>
</phpunit>
```

### Fichier `tests/bootstrap.php`

Ce fichier charge les dépendances avant les tests :

```php
<?php
// tests/bootstrap.php

require __DIR__ . '/../vendor/autoload.php';

// Configuration de l'environnement de test
define('ROOT', dirname(__DIR__));
define('TESTS', __DIR__);
```

---

## Les Tests Existants

### 1. Tests de l'Entity User (`UserTest.php`)

#### Vue d'ensemble

```
✔ Create user with valid data          - Création valide
✔ Create user with all parameters       - Tous les paramètres
✔ Create user with invalid email        - Email invalide
✔ Create user with email no at          - Email sans @
✔ Create user with empty name           - Name vide
✔ Create user with name too short       - Name trop court
✔ Get email                              - Getter email
✔ Get name                               - Getter name
✔ Get created at                         - Getter created_at
✔ Get updated at                         - Getter updated_at
✔ Email validation with various formats  - Formats d'email invalides
✔ Valid email formats                    - Formats d'email valides
✔ User to array                          - Conversion en array
```

#### Code d'Exemple: Test de Création Valide

```php
public function testCreateUserWithValidData(): void
{
    // Arrange - Préparer les données
    $email = 'john@example.com';
    $name = 'John Doe';

    // Act - Exécuter le code
    $user = new User($email, $name);

    // Assert - Vérifier les résultats
    $this->assertNull($user->getId());
    $this->assertEquals($email, $user->getEmail());
    $this->assertEquals($name, $user->getName());
    $this->assertNotNull($user->getCreatedAt());
    $this->assertNull($user->getUpdatedAt());
}
```

#### Code d'Exemple: Test de Validation

```php
public function testCreateUserWithInvalidEmail(): void
{
    // Vérifier qu'une exception est levée
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage('Invalid email format');

    // Essayer de créer un utilisateur avec email invalide
    new User('not-an-email', 'John Doe');
}
```

### 2. Tests CreateUserUseCase

#### Vue d'ensemble

```
✔ Create user successfully               - Création réussie
✔ Create user with duplicate email       - Email dupliqué
✔ Create user with invalid email         - Email invalide
✔ Create user with empty name            - Name vide
✔ Create user with name too short        - Name trop court
✔ Repository called with correct params  - Vérification appels
```

#### Code d'Exemple: Test avec Mocks

```php
public function testCreateUserSuccessfully(): void
{
    $email = 'john@example.com';
    $name = 'John Doe';

    // Mock du repository
    $this->repositoryMock
        ->expects($this->once())
        ->method('findByEmail')
        ->with($email)
        ->willReturn(null);  // L'utilisateur n'existe pas

    $savedUser = new User($email, $name, 1);
    $this->repositoryMock
        ->expects($this->once())
        ->method('save')
        ->willReturn($savedUser);

    // Exécuter le use case
    $result = $this->useCase->execute($email, $name);

    // Vérifier les résultats
    $this->assertEquals($email, $result->getEmail());
    $this->assertEquals(1, $result->getId());
}
```

### 3. Tests GetUserUseCase

#### Vue d'ensemble

```
✔ Get user by id successfully            - Récupération réussie
✔ Get user not found                     - User introuvable
✔ Get all users                          - Tous les users
✔ Get all users empty                    - Liste vide
✔ Repository called with correct id      - Vérification appels
✔ Multiple calls to get all              - Appels multiples
```

---

## Comment Écrire des Tests

### Structure de Base d'un Test

Tous les tests suivent le pattern **AAA** (Arrange-Act-Assert):

```php
<?php
declare(strict_types=1);

namespace Tests\TestCase\Domain\User\Entity;

use Domain\User\Entity\User;
use PHPUnit\Framework\TestCase;

class MyNewTest extends TestCase
{
    /**
     * Description du test
     */
    public function testSomethingWorks(): void
    {
        // ===== ARRANGE =====
        // Préparer les données et les conditions
        $email = 'test@example.com';
        $name = 'Test User';

        // ===== ACT =====
        // Exécuter le code à tester
        $user = new User($email, $name);

        // ===== ASSERT =====
        // Vérifier les résultats
        $this->assertEquals($email, $user->getEmail());
    }
}
```

### Les Assertions Courantes

```php
// Égalité
$this->assertEquals($expected, $actual);
$this->assertNotEquals($expected, $actual);

// Vérification NULL
$this->assertNull($value);
$this->assertNotNull($value);

// Vérification booléenne
$this->assertTrue($condition);
$this->assertFalse($condition);

// Collections
$this->assertCount(3, $array);
$this->assertContains('value', $array);
$this->assertArrayHasKey('key', $array);

// Instances
$this->assertInstanceOf(User::class, $object);

// Exceptions
$this->expectException(Exception::class);
$this->expectExceptionMessage('Message attendu');
```

### Exemple Complet: Test de Validation

```php
<?php
public function testValidateUserEmailFormat(): void
{
    // ARRANGE
    $validEmails = [
        'john@example.com',
        'jane.doe@company.co.uk',
        'user+tag@domain.org',
    ];

    // ACT & ASSERT
    foreach ($validEmails as $email) {
        $user = new User($email, 'Test User');
        $this->assertEquals($email, $user->getEmail());
    }
}

public function testValidateUserInvalidEmail(): void
{
    // ARRANGE & ACT & ASSERT
    $this->expectException(InvalidArgumentException::class);
    new User('invalid-email', 'Test User');
}
```

---

## Les Mocks et Stubs

### Pourquoi Utiliser les Mocks ?

Les **mocks** permettent d'isoler le code testé en remplaçant les dépendances externes:

```
Sans Mock: User → Repository → Database  ❌ Compliqué
Avec Mock:  User → Mock Repository        ✅ Simple et rapide
```

### Créer et Utiliser des Mocks

#### 1. Créer un Mock

```php
class CreateUserUseCaseTest extends TestCase
{
    private CreateUserUseCase $useCase;
    private UserRepositoryInterface&MockObject $repositoryMock;

    protected function setUp(): void
    {
        // Créer un mock du repository
        $this->repositoryMock = $this->createMock(UserRepositoryInterface::class);
        
        // Injecter le mock au use case
        $this->useCase = new CreateUserUseCase($this->repositoryMock);
    }
}
```

#### 2. Configurer le Mock

```php
// S'attendre à ce que la méthode findByEmail soit appelée UNE fois
$this->repositoryMock
    ->expects($this->once())           // Exactement 1 fois
    ->method('findByEmail')             // La méthode findByEmail
    ->with($email)                      // Avec cet argument
    ->willReturn(null);                 // Retourne null
```

#### 3. Options `expects()`

```php
// Exactement N fois
->expects($this->exactly(2))

// Au moins 1 fois
->expects($this->atLeastOnce())

// Jamais
->expects($this->never())

// N'importe combien
->expects($this->any())
```

#### 4. Callback pour Arguments Complexes

```php
$this->repositoryMock
    ->expects($this->once())
    ->method('save')
    ->with($this->callback(function ($user) use ($email) {
        // Vérifier que l'user a le bon email
        return $user->getEmail() === $email;
    }))
    ->willReturn($savedUser);
```

### Exemple Complet avec Mock

```php
public function testCreateUserWithDuplicateEmailThrowsException(): void
{
    // ARRANGE
    $email = 'john@example.com';
    $existingUser = new User($email, 'Existing', 1);

    // Mock: Simuler qu'un utilisateur existe déjà
    $this->repositoryMock
        ->expects($this->once())
        ->method('findByEmail')
        ->with($email)
        ->willReturn($existingUser);

    // Mock: save ne doit JAMAIS être appelé
    $this->repositoryMock
        ->expects($this->never())
        ->method('save');

    // ACT & ASSERT
    $this->expectException(RuntimeException::class);
    $this->expectExceptionMessage('User with this email already exists');
    
    $this->useCase->execute($email, 'John Doe');
}
```

---

## Lancer les Tests

### 1. Exécuter Tous les Tests

```bash
cd /Users/badrtairlbahre/Desktop/Projects/skeleton-cakephp

# Format classique
./vendor/bin/phpunit tests/TestCase/

# Format testdox (lisible)
./vendor/bin/phpunit tests/TestCase/ --testdox

# Avec couleurs
./vendor/bin/phpunit tests/TestCase/ --testdox --colors=always
```

### 2. Exécuter des Tests Spécifiques

```bash
# Uniquement le domaine
./vendor/bin/phpunit tests/TestCase/Domain/ --testdox

# Uniquement l'application
./vendor/bin/phpunit tests/TestCase/Application/ --testdox

# Un fichier spécifique
./vendor/bin/phpunit tests/TestCase/Domain/User/Entity/UserTest.php --testdox

# Une méthode spécifique
./vendor/bin/phpunit --filter testCreateUserWithValidData tests/TestCase/
```

### 3. Options Utiles

```bash
# Afficher la couverture de code (html)
./vendor/bin/phpunit tests/ --coverage-html=coverage/

# S'arrêter au premier échec
./vendor/bin/phpunit tests/ --stop-on-failure

# Verbose
./vendor/bin/phpunit tests/ -v

# Lister les tests sans les exécuter
./vendor/bin/phpunit --list-tests tests/TestCase/
```

### 4. Résultat Expected

```
PHPUnit 10.5.58 by Sebastian Bergmann

.........................                                 25 / 25 (100%)

Time: 00:00.035, Memory: 12.00 MB

✔ Create User Use Case (6 tests)
✔ Get User Use Case (6 tests)
✔ User Domain Entity (13 tests)

OK (25 tests, 65 assertions)
```

---

## Best Practices

### ✅ À FAIRE

#### 1. Noms Descriptifs

```php
// ✅ BON - Le nom décrit exactement ce qui est testé
public function testCreateUserWithValidDataSucceeds(): void {}
public function testUserWithInvalidEmailThrowsException(): void {}
public function testRepositoryFindByEmailIsCalledOnce(): void {}

// ❌ MAUVAIS - Vague et peu informatif
public function testUser(): void {}
public function testCreate(): void {}
public function testValidation(): void {}
```

#### 2. Un Concept par Test

```php
// ✅ BON - Test une seule chose
public function testEmailValidation(): void {
    $this->expectException(InvalidArgumentException::class);
    new User('invalid', 'John');
}

// ❌ MAUVAIS - Teste plusieurs concepts
public function testUserCreation(): void {
    $user = new User('john@example.com', 'John');
    $this->assertEquals('john@example.com', $user->getEmail());
    $this->assertEquals('John', $user->getName());
    $this->assertNotNull($user->getCreatedAt());
    // Trop de vérifications
}
```

#### 3. Données de Test Réalistes

```php
// ✅ BON - Données réalistes
$email = 'john@example.com';
$name = 'John Doe';

// ❌ MAUVAIS - Données bizarres
$email = 'a@b.c';
$name = 'x';
```

#### 4. Tester les Cas Limites

```php
public function testUserNameValidation(): void
{
    // Nom trop court (1 caractère)
    $this->expectException(InvalidArgumentException::class);
    new User('test@example.com', 'A');

    // Nom vide
    $this->expectException(InvalidArgumentException::class);
    new User('test@example.com', '');

    // Nom valide
    $user = new User('test@example.com', 'AB');
    $this->assertEquals('AB', $user->getName());
}
```

### ❌ À ÉVITER

#### 1. Tests Qui Dépendent de l'Ordre

```php
// ❌ MAUVAIS - Le deuxième test dépend du premier
public function testCreateUser(): void {
    global $userId;
    $userId = 1; // Modifie une variable globale
}

public function testGetUser(): void {
    global $userId;
    // Dépend de $userId défini dans le test précédent
}

// ✅ BON - Tests indépendants
public function testCreateUser(): void {
    $user = new User('john@example.com', 'John');
    // Ne dépend d'aucun autre test
}

public function testGetUser(): void {
    // Utilise ses propres données
}
```

#### 2. Accès à la Base de Données Réelle

```php
// ❌ MAUVAIS - Accès database (lent, non isolé)
public function testCreateUser(): void {
    $repo = new UserRepository(); // Repository réel
    $user = $repo->save(new User(...));
    // Lent, dépend de la DB, données réelles
}

// ✅ BON - Mock du repository
public function testCreateUser(): void {
    $repoMock = $this->createMock(UserRepositoryInterface::class);
    $repoMock->expects($this->once())->method('save');
    // Rapide, isolé, pas d'effets de bord
}
```

#### 3. Trop de Mocks

```php
// ❌ MAUVAIS - Trop de dépendances mockées
public function testSomething(): void {
    $mock1 = $this->createMock(Service1::class);
    $mock2 = $this->createMock(Service2::class);
    $mock3 = $this->createMock(Service3::class);
    // Difficile à maintenir, peu pertinent
}

// ✅ BON - Mock seulement les vraies dépendances
public function testSomething(): void {
    $repoMock = $this->createMock(UserRepositoryInterface::class);
    // Clear et maintenable
}
```

---

## Déboguer les Tests

### 1. Afficher des Informations

```php
public function testSomething(): void
{
    $user = new User('john@example.com', 'John');
    
    // Afficher la valeur
    var_dump($user);
    
    // Ou utiliser fwrite
    fwrite(STDERR, 'User email: ' . $user->getEmail() . PHP_EOL);
    
    $this->assertTrue(true);
}
```

### 2. Lancer avec Xdebug

```bash
# Activer le debugger
export XDEBUG_CONFIG="idekey=phpstorm"
./vendor/bin/phpunit tests/TestCase/Domain/User/Entity/UserTest.php
```

### 3. Afficher les Assertions Échouées

```bash
# Mode verbose
./vendor/bin/phpunit tests/ -v

# S'arrêter au premier échec
./vendor/bin/phpunit tests/ --stop-on-failure

# Avec stack trace complet
./vendor/bin/phpunit tests/ --display-deprecations
```

### 4. Exemple: Débogage d'un Test Échoué

```php
public function testUserCreation(): void
{
    $email = 'john@example.com';
    
    try {
        $user = new User($email, 'John');
        echo "User created: " . $user->getEmail() . PHP_EOL;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . PHP_EOL;
        throw $e;
    }
    
    $this->assertEquals($email, $user->getEmail());
}
```

---

## Exercices Pratiques

### Exercice 1: Créer un Nouveau Test

Créez un test pour la méthode `toArray()` de la classe User:

```php
/**
 * Créer le test tests/TestCase/Domain/User/Entity/UserToArrayTest.php
 * 
 * Tester:
 * 1. Que la méthode retourne un array
 * 2. Que l'array contient les bonnes clés
 * 3. Que les valeurs sont correctes
 */
```

**Solution**:
```php
public function testUserToArray(): void
{
    $user = new User('john@example.com', 'John', 1);
    $array = $user->toArray();
    
    $this->assertIsArray($array);
    $this->assertArrayHasKey('id', $array);
    $this->assertArrayHasKey('email', $array);
    $this->assertEquals(1, $array['id']);
    $this->assertEquals('john@example.com', $array['email']);
}
```

### Exercice 2: Ajouter des Tests d'Edge Cases

Ajoutez des tests pour les cas limites du validation d'email:

```php
/**
 * Tester les formats d'email edge:
 * - "user+tag@example.com" (valide)
 * - "user_name@sub.domain.com" (valide)
 * - "user@localhost" (invalide selon filter_var)
 */
```

---

## Ressources Supplémentaires

### Documentation Officielle

- **PHPUnit**: https://phpunit.de/documentation.html
- **PHPUnit Manual**: https://docs.phpunit.de/en/10.5/

### Lectures Recommandées

- "Test-Driven Development: By Example" - Kent Beck
- "Growing Object-Oriented Software, Guided by Tests" - Freeman & Pryce

### Commandes Utiles

```bash
# Créer une nouvelle classe de test avec stub
./vendor/bin/phpunit-generator \
    src/Domain/User/Entity/User.php \
    tests/TestCase/Domain/User/Entity/UserTest.php

# Générer une couverture de code
./vendor/bin/phpunit tests/ \
    --coverage-html=coverage/ \
    --coverage-report-text

# Exécuter les tests en parallèle
./vendor/bin/phpunit tests/ --processes=4
```

---

## Conclusion

✅ Les tests unitaires sont essentiels pour:
- Garantir la qualité du code
- Faciliter les refactorings
- Documenter le comportement attendu
- Détecter les régressions

✅ Suivez le pattern **AAA** (Arrange-Act-Assert)  
✅ Utilisez des **mocks** pour isoler le code  
✅ Écrivez des noms **descriptifs**  
✅ Testez les **cas limites**  
✅ Maintenez une **couverture élevée**  

**Bon testing! 🚀**
