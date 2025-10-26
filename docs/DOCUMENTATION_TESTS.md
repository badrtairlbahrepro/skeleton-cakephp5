# 📚 Documentation des Tests Unitaires

## 📋 Sommaire

- [TESTING.md](#testingmd) - Guide complet (795 lignes)
- [TESTS_QUICKSTART.md](#tests_quickstartmd) - Guide rapide (193 lignes)
- [Structure des tests](#structure-des-tests)
- [Résumé des tests](#résumé-des-tests)

---

## TESTING.md

**Fichier complet et détaillé - 19 KB**

### Contenu:

1. **Introduction aux Tests Unitaires**
   - Qu'est-ce qu'un test unitaire?
   - Avantages des tests
   - Framework PHPUnit

2. **Structure du Projet**
   - Arborescence des tests
   - Conventions de nommage
   - Organisation des fichiers

3. **Configuration PHPUnit**
   - Fichier `phpunit.xml.dist`
   - Fichier `tests/bootstrap.php`

4. **Les Tests Existants**
   - Tests de l'Entity User (13 tests)
   - Tests CreateUserUseCase (6 tests)
   - Tests GetUserUseCase (6 tests)
   - Exemples de code

5. **Comment Écrire des Tests**
   - Structure de base (pattern AAA)
   - Assertions courantes
   - Exemples complets

6. **Les Mocks et Stubs**
   - Pourquoi utiliser les mocks?
   - Créer et configurer des mocks
   - Options `expects()`
   - Callbacks pour arguments complexes
   - Exemple complet avec mocks

7. **Lancer les Tests**
   - Tous les tests
   - Tests spécifiques
   - Options utiles
   - Résultats expected

8. **Best Practices**
   - À faire ✅
   - À éviter ❌
   - Noms descriptifs
   - Un concept par test
   - Données réalistes
   - Cas limites

9. **Déboguer les Tests**
   - Afficher des informations
   - Xdebug
   - Assertions échouées
   - Débogage d'exemple

10. **Exercices Pratiques**
    - Créer un nouveau test
    - Ajouter des edge cases
    - Avec solutions

11. **Ressources Supplémentaires**
    - Documentation officielle
    - Lectures recommandées
    - Commandes utiles

---

## TESTS_QUICKSTART.md

**Guide rapide et pratique - 3.4 KB**

### Contenu:

1. **Lancer les Tests en 30 Secondes**
   - Commande basique
   - Résultat attendu

2. **Commandes Courantes**
   - Tous les tests
   - Tests domaine
   - Tests application
   - Fichier spécifique
   - Méthode spécifique
   - S'arrêter au premier échec

3. **Structure des Tests**
   - Fichiers créés
   - Tests disponibles par layer

4. **Pattern AAA**
   - Arrange-Act-Assert
   - Exemple

5. **Assertions Courantes**
   - Égalité
   - Exceptions
   - Collections
   - Nullité
   - Types

6. **Mocks**
   - Créer un mock
   - Configurer

7. **Statistiques**
   - Nombre de tests
   - Assertions
   - Couverture
   - Temps

8. **Tips & Tricks**
   - Voir les noms des tests
   - Verbose mode
   - Parallèle
   - Warnings

---

## Structure des Tests

```
tests/
├── bootstrap.php                                    # Amorçage
└── TestCase/
    ├── Application/
    │   └── UseCases/
    │       └── User/
    │           ├── CreateUserUseCaseTest.php       # 6 tests
    │           └── GetUserUseCaseTest.php          # 6 tests
    └── Domain/
        └── User/
            └── Entity/
                └── UserTest.php                    # 13 tests
```

**Total**: 3 fichiers de test, 25 tests, 65 assertions

---

## Résumé des Tests

### ✅ Domain Layer (13 tests)

**UserTest.php**

```
✔ Create user with valid data
✔ Create user with all parameters
✔ Create user with invalid email
✔ Create user with email no at
✔ Create user with empty name
✔ Create user with name too short
✔ Get email
✔ Get name
✔ Get created at
✔ Get updated at
✔ Email validation with various invalid formats
✔ Valid email formats
✔ User to array
```

**Coverage:**
- ✅ Entity creation
- ✅ Email validation
- ✅ Name validation
- ✅ Date/Time handling
- ✅ Getters
- ✅ Array conversion

### ✅ Application Layer (12 tests)

**CreateUserUseCaseTest.php** (6 tests)

```
✔ Create user successfully
✔ Create user with duplicate email
✔ Create user with invalid email
✔ Create user with empty name
✔ Create user with name too short
✔ Repository called with correct parameters
```

**GetUserUseCaseTest.php** (6 tests)

```
✔ Get user by id successfully
✔ Get user not found
✔ Get all users
✔ Get all users empty
✔ Repository called with correct id
✔ Multiple calls to get all
```

**Coverage:**
- ✅ Use case orchestration
- ✅ Exception handling
- ✅ Repository mocking
- ✅ Business rules
- ✅ Edge cases

---

## Statistiques

```
┌─────────────────────────────────┐
│  Statistiques des Tests         │
├─────────────────────────────────┤
│ Tests Exécutés      : 25        │
│ Assertions          : 65        │
│ Temps d'Exécution   : ~35-43ms  │
│ Mémoire Utilisée    : 12 MB     │
│ PHP Version         : 8.1.31    │
│ PHPUnit Version     : 10.5.58   │
│ Taux de Réussite    : 100% ✅   │
└─────────────────────────────────┘
```

---

## Commandes Principales

### Pour Commencer

```bash
# Installer les dépendances
composer install

# Lancer tous les tests
./vendor/bin/phpunit tests/TestCase/ --testdox

# Voir les noms des tests
./vendor/bin/phpunit --list-tests tests/TestCase/
```

### Tests Spécifiques

```bash
# Domaine seulement
./vendor/bin/phpunit tests/TestCase/Domain/ --testdox

# Application seulement
./vendor/bin/phpunit tests/TestCase/Application/ --testdox

# Un fichier spécifique
./vendor/bin/phpunit tests/TestCase/Domain/User/Entity/UserTest.php --testdox

# Une méthode spécifique
./vendor/bin/phpunit --filter testCreateUserWithValidData tests/TestCase/
```

### Options Avancées

```bash
# S'arrêter au premier échec
./vendor/bin/phpunit tests/ --stop-on-failure

# Verbose mode
./vendor/bin/phpunit tests/ -v

# Couverture de code (HTML)
./vendor/bin/phpunit tests/ --coverage-html=coverage/

# Couverture textuelle
./vendor/bin/phpunit tests/ --coverage-text

# Parallèle (4 processus)
./vendor/bin/phpunit tests/ --processes=4

# Avec couleurs
./vendor/bin/phpunit tests/ --testdox --colors=always
```

---

## Pattern Utilisé: AAA (Arrange-Act-Assert)

### Structure Générale

```php
public function testSomething(): void
{
    // ARRANGE - Préparer les données et conditions
    $user = new User('john@example.com', 'John');

    // ACT - Exécuter le code à tester
    $result = $user->getEmail();

    // ASSERT - Vérifier les résultats
    $this->assertEquals('john@example.com', $result);
}
```

---

## Assertions Disponibles

### Comparaisons

```php
$this->assertEquals($expected, $actual);
$this->assertNotEquals($expected, $actual);
$this->assertSame($expected, $actual);           // === strict
$this->assertNotSame($expected, $actual);
```

### Nullité

```php
$this->assertNull($value);
$this->assertNotNull($value);
```

### Booléen

```php
$this->assertTrue($condition);
$this->assertFalse($condition);
```

### Collections

```php
$this->assertCount($count, $array);
$this->assertContains($value, $array);
$this->assertArrayHasKey($key, $array);
$this->assertArrayNotHasKey($key, $array);
```

### Instances

```php
$this->assertInstanceOf(ClassName::class, $object);
$this->assertNotInstanceOf(ClassName::class, $object);
```

### Exceptions

```php
$this->expectException(Exception::class);
$this->expectExceptionMessage('Expected message');
$this->expectExceptionCode(123);
```

### Types

```php
$this->assertIsArray($value);
$this->assertIsString($value);
$this->assertIsInt($value);
$this->assertIsFloat($value);
$this->assertIsBool($value);
```

---

## Mocks: Guide Complet

### Créer un Mock

```php
$mock = $this->createMock(UserRepositoryInterface::class);
```

### Configurer un Mock

```php
$mock
    ->expects($this->once())              // Appelé exactement 1 fois
    ->method('findByEmail')                // La méthode
    ->with('john@example.com')             // Avec cet argument
    ->willReturn(null);                    // Retourne null
```

### Options expects()

```php
->expects($this->once())                  // Exactement 1 fois
->expects($this->exactly(2))              // Exactement 2 fois
->expects($this->atLeastOnce())           // Au moins 1 fois
->expects($this->never())                 // Jamais
->expects($this->any())                   // N'importe combien
```

### Retours Avancés

```php
->willReturn($value)                      // Retourne une valeur
->willReturnOnConsecutiveCalls($v1, $v2)  // Retours différents
->willThrowException(new Exception())     // Lance une exception
->willReturnSelf()                        // Retourne le mock lui-même
```

### Callbacks

```php
->with($this->callback(function ($arg) {
    return $arg->getId() === 1;  // Vérification personnalisée
}))
```

---

## Bonnes Pratiques

### ✅ À Faire

1. **Noms Descriptifs**
   ```php
   testCreateUserWithValidDataSucceeds()
   testUserWithInvalidEmailThrowsException()
   testRepositoryFindByEmailIsCalledOnce()
   ```

2. **Un Concept par Test**
   - Un test = Une vérification
   - Pas de logique complexe
   - Pas de boucles quand possible

3. **Données Réalistes**
   - 'john@example.com' au lieu de 'a@b.c'
   - 'John Doe' au lieu de 'x'

4. **Tester les Cas Limites**
   - Valeurs vides/nulles
   - Longueurs min/max
   - Formats invalides

5. **Indépendance**
   - Chaque test doit être autonome
   - Pas de dépendances d'ordre
   - Pas d'état global

### ❌ À Éviter

1. **Tests qui dépendent de l'ordre**
   ```php
   // ❌ MAUVAIS
   testA() { global $var = 1; }
   testB() { global $var; ... }  // Dépend de testA
   ```

2. **Accès à la base de données réelle**
   ```php
   // ❌ MAUVAIS
   $repo = new UserRepository();  // Accès réel
   
   // ✅ BON
   $mock = $this->createMock(UserRepositoryInterface::class);
   ```

3. **Trop de mocks**
   - Mock seulement les vraies dépendances
   - Pas les services légers

4. **Assertions vagues**
   ```php
   // ❌ MAUVAIS
   $this->assertTrue($result);
   
   // ✅ BON
   $this->assertEquals('john@example.com', $result->getEmail());
   ```

---

## Débogage

### Afficher des Informations

```php
var_dump($variable);
echo "Value: " . $value . PHP_EOL;
fwrite(STDERR, 'Debug: ' . $msg . PHP_EOL);
```

### Options de Débogage

```bash
# Verbose
./vendor/bin/phpunit tests/ -v

# S'arrêter au premier échec
./vendor/bin/phpunit tests/ --stop-on-failure

# Afficher les deprecations
./vendor/bin/phpunit tests/ --display-deprecations

# Stack trace complet
./vendor/bin/phpunit tests/ --verbose
```

### Xdebug

```bash
export XDEBUG_CONFIG="idekey=phpstorm"
./vendor/bin/phpunit tests/TestCase/Domain/User/Entity/UserTest.php
```

---

## Ressources

### Documentation Officielle
- **PHPUnit**: https://phpunit.de/
- **Documentation**: https://docs.phpunit.de/en/10.5/

### Lectures
- "Test-Driven Development" - Kent Beck
- "Growing Object-Oriented Software" - Freeman & Pryce

### Fichiers du Projet
- `TESTING.md` - Guide complet détaillé
- `TESTS_QUICKSTART.md` - Guide rapide
- `phpunit.xml.dist` - Configuration
- `tests/bootstrap.php` - Amorçage

---

## Conclusion

✅ **25 tests**, 65 assertions, **100% de réussite**

✅ Tests couvrant:
- Entity validation
- Use case orchestration  
- Exception handling
- Repository mocking
- Edge cases

✅ Prêt pour:
- CI/CD pipeline
- Refactoring confiant
- Production deployment

**Bon testing! 🚀**
