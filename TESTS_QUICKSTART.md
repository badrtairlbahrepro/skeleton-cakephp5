# 🚀 Tests Unitaires - Guide Rapide

## Lancer les Tests en 30 Secondes

### Commande Basique

```bash
cd /Users/badrtairlbahre/Desktop/Projects/skeleton-cakephp

# Tous les tests
./vendor/bin/phpunit tests/TestCase/ --testdox
```

### Résultat Attendu

```
✔ 25 tests, 65 assertions
✔ Temps: ~35ms
✔ Mémoire: 12 MB
```

---

## Commandes Courantes

### Exécuter Tous les Tests
```bash
./vendor/bin/phpunit tests/TestCase/ --testdox
```

### Tests Domaine Seulement
```bash
./vendor/bin/phpunit tests/TestCase/Domain/ --testdox
```

### Tests Application Seulement
```bash
./vendor/bin/phpunit tests/TestCase/Application/ --testdox
```

### Un Fichier Spécifique
```bash
./vendor/bin/phpunit tests/TestCase/Domain/User/Entity/UserTest.php --testdox
```

### Une Méthode Spécifique
```bash
./vendor/bin/phpunit --filter testCreateUserWithValidData tests/TestCase/ --testdox
```

### S'Arrêter au Premier Échec
```bash
./vendor/bin/phpunit tests/TestCase/ --stop-on-failure --testdox
```

---

## Structure des Tests

### 📁 Fichiers de Test Créés

1. **`tests/TestCase/Domain/User/Entity/UserTest.php`**
   - 13 tests pour la validation de l'Entity User

2. **`tests/TestCase/Application/UseCases/User/CreateUserUseCaseTest.php`**
   - 6 tests pour CreateUserUseCase avec mocks

3. **`tests/TestCase/Application/UseCases/User/GetUserUseCaseTest.php`**
   - 6 tests pour GetUserUseCase avec mocks

### ✔ Tests Disponibles

**Domain Layer:**
- ✅ User entity creation
- ✅ Email validation
- ✅ Name validation
- ✅ Getters
- ✅ Array conversion

**Application Layer:**
- ✅ User creation orchestration
- ✅ User retrieval
- ✅ Error handling
- ✅ Repository interactions

---

## Pattern AAA

Tous les tests suivent le pattern **Arrange-Act-Assert**:

```php
public function testSomething(): void
{
    // ARRANGE - Préparer
    $user = new User('john@example.com', 'John');

    // ACT - Exécuter
    $email = $user->getEmail();

    // ASSERT - Vérifier
    $this->assertEquals('john@example.com', $email);
}
```

---

## Assertions Courantes

```php
// Égalité
$this->assertEquals($expected, $actual);

// Exceptions
$this->expectException(Exception::class);
$this->expectExceptionMessage('Message');

// Collections
$this->assertCount(3, $array);
$this->assertContains('value', $array);

// Nullité
$this->assertNull($value);
$this->assertNotNull($value);

// Types
$this->assertIsArray($value);
$this->assertInstanceOf(User::class, $object);
```

---

## Mocks

```php
// Créer un mock
$mock = $this->createMock(UserRepositoryInterface::class);

// Configurer le mock
$mock
    ->expects($this->once())           // Appelé une fois
    ->method('save')                   // La méthode
    ->with($user)                      // Avec cet argument
    ->willReturn($savedUser);          // Retourne ceci
```

---

## Statistiques

```
Tests: 25
Assertions: 65
Couverture: Domain + Application layers
Temps: ~35ms
Status: ✅ All Passing
```

---

## Ressources

- 📖 Guide complet: `TESTING.md`
- 📚 PHPUnit: https://phpunit.de/
- 🔗 Configuration: `phpunit.xml.dist`

---

## Tips & Tricks

### Voir les Noms des Tests
```bash
./vendor/bin/phpunit --list-tests tests/TestCase/
```

### Verbose Mode
```bash
./vendor/bin/phpunit tests/ -v
```

### Parallèle (si dépendances permettent)
```bash
./vendor/bin/phpunit tests/ --processes=4
```

### Afficher les Warnings
```bash
./vendor/bin/phpunit tests/ --display-deprecations
```

---

**Bon testing! 🚀**
