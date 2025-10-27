# CakePHP - Squelette avec Architecture Hexagonale

Squelette d'application CakePHP 5 implémentant l'**Architecture Hexagonale** (Ports & Adapters), le **Domain-Driven Design (DDD)**, l'injection automatique de dépendances, et intégrant **AdminLTE** pour l'interface d'administration.

## 🏗️ Architecture

Le projet suit les principes de l'**Architecture Propre** avec trois couches principales :

### 1. **Couche Domaine** (`src/Domain/`)
Contient la logique métier pure, indépendante du framework.

```
src/Domain/
└── User/
    ├── Entity/User.php              # Entité métier avec règles de gestion
    └── Repository/UserRepositoryInterface.php  # Port (interface)
```

### 2. **Couche Application** (`src/Application/`)
Orchestre les cas d'usage et la logique métier.

```
src/Application/
└── UseCases/
    └── User/
        ├── CreateUserUseCase.php     # Cas d'usage : création utilisateur
        └── GetUserUseCase.php        # Cas d'usage : récupération utilisateur
```

### 3. **Couche Infrastructure** (`src/Infrastructure/`)
Implémentations spécifiques au framework (CakePHP ORM, services externes).

```
src/Infrastructure/
├── DependencyInjection/ServiceProvider.php  # Configuration DI
└── Persistence/CakeOrm/
    ├── UserRepository.php            # Implémentation du repository
    └── Table/UsersTable.php          # Table CakePHP ORM
```

## ✨ Fonctionnalités

- ✅ **Architecture Hexagonale** - Séparation claire des responsabilités
- ✅ **Domain-Driven Design** - Modèles de domaine riches avec logique métier
- ✅ **Injection de Dépendances Automatique** - Conteneur DI de CakePHP 5
- ✅ **AdminLTE 3** - Interface d'administration moderne et responsive
- ✅ **Tests Unitaires** - 25 tests couvrant la logique métier
- ✅ **Outils de Qualité** - PHPStan, CodeSniffer, PHPUnit
- ✅ **Plugins** - LogViewer et FormBuilder disponibles
- ✅ **Principes SOLID** - Code maintenable et testable

## 🚀 Démarrage Rapide

### Prérequis

- PHP 8.1 ou supérieur
- Composer
- MySQL/MariaDB ou PostgreSQL
- Serveur web (Apache/Nginx) ou serveur PHP intégré

### Installation

1. **Installer les dépendances :**
```bash
composer install
```

2. **Configurer la base de données :**
```bash
cp config/app_local.example.php config/app_local.php
```

Éditez `config/app_local.php` et configurez votre base de données :
```php
'Datasources' => [
    'default' => [
        'host' => 'localhost',
        'username' => 'votre_utilisateur',
        'password' => 'votre_mot_de_passe',
        'database' => 'votre_base_de_donnees',
    ],
],
```

3. **Exécuter les migrations :**
```bash
bin/cake migrations migrate
```

4. **Démarrer le serveur :**
```bash
bin/cake server
```

5. **Ouvrir dans votre navigateur :**
```
http://localhost:8765
```

## 📁 Structure du Projet

```
skeleton-cakephp/
├── bin/                    # Scripts exécutables
│   └── cake               # Console CakePHP
├── config/                # Fichiers de configuration
│   ├── app.php           # Configuration principale
│   ├── routes.php        # Définitions de routes
│   └── Migrations/       # Migrations base de données
├── src/
│   ├── Application.php   # Classe Application avec config DI
│   ├── Controller/       # Contrôleurs (couche présentation)
│   ├── View/            # Classes de vue
│   ├── Domain/          # 🏢 Couche domaine (logique métier)
│   ├── Application/      # 🎯 Couche application (cas d'usage)
│   └── Infrastructure/   # 🔌 Couche infrastructure (adaptateurs)
├── templates/            # Templates de vue
│   ├── layout/          # Layouts AdminLTE
│   └── Pages/           # Pages statiques
├── webroot/             # Répertoire public
└── tests/                # Fichiers de test (25 tests)
```

## 🎯 Injection de Dépendances

Le projet utilise l'injection automatique de dépendances via le conteneur DI de CakePHP. Les services sont automatiquement résolus et injectés dans les contrôleurs.

### Exemple : Contrôleur avec DI

```php
class UsersController extends AppController
{
    // Le cas d'usage est automatiquement injecté
    public function index(GetUserUseCase $getUserUseCase): void
    {
        $users = $getUserUseCase->getAll();
        $this->set(compact('users'));
    }
}
```

### Enregistrer des Services

Les services sont enregistrés dans `src/Infrastructure/DependencyInjection/ServiceProvider.php` :

```php
public function register(ContainerInterface $container): void
{
    // Enregistrer l'interface de repository vers l'implémentation
    $container->add(UserRepositoryInterface::class, UserRepository::class);
    
    // Enregistrer les cas d'usage avec leurs dépendances
    $container->add(CreateUserUseCase::class)
        ->addArgument(UserRepositoryInterface::class);
}
```

## 🎨 Plugins Disponibles

### 📊 LogViewer
Visualiseur de logs avec recherche et filtres, export CSV/JSON, statistiques.

**Accès :** http://localhost:8765/logs

### 📝 AdminLteForm
Générateur de formulaires avec composants AdminLTE (boutons, inputs, selects, etc.).

**Accès :** http://localhost:8765/form-builder

### 🧪 CakeQualityTools
Dashboard pour lancer les tests PHPUnit, analyses PHPStan et vérifications CodeSniffer.

**Accès :** http://localhost:8765/quality-tools

## 🧪 Tests et Qualité

### Exécuter les Tests

```bash
# Tous les tests
composer test

# Ou directement
./vendor/bin/phpunit tests/ --testdox
```

**Résultats actuels :**
- ✅ 25 tests PHPUnit
- ✅ 65 assertions
- ✅ Temps d'exécution : ~35ms

### Vérifier le Style de Code

```bash
# Vérifier
composer cs-check

# Corriger automatiquement
composer cs-fix
```

### Analyse Statique (PHPStan)

```bash
composer stan
```

**Configuration :**
- Niveau : 8 (avancé)
- Erreurs détectées : 0

## 🎯 Créer de Nouvelles Fonctionnalités

### 1. Créer une Entité Domaine

```php
// src/Domain/Product/Entity/Product.php
namespace Domain\Product\Entity;

class Product
{
    private ?int $id;
    private string $name;
    private float $price;
    
    // Logique métier et validation
}
```

### 2. Créer une Interface de Repository

```php
// src/Domain/Product/Repository/ProductRepositoryInterface.php
namespace Domain\Product\Repository;

interface ProductRepositoryInterface
{
    public function findById(int $id): ?Product;
    public function save(Product $product): Product;
}
```

### 3. Créer un Cas d'Usage

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

### 4. Implémenter le Repository

```php
// src/Infrastructure/Persistence/CakeOrm/ProductRepository.php
namespace Infrastructure\Persistence\CakeOrm;

class ProductRepository implements ProductRepositoryInterface
{
    // Implémentation avec CakePHP ORM
}
```

### 5. Enregistrer dans le Conteneur DI

```php
// src/Infrastructure/DependencyInjection/ServiceProvider.php
$container->add(ProductRepositoryInterface::class, ProductRepository::class);
$container->add(CreateProductUseCase::class)
    ->addArgument(ProductRepositoryInterface::class);
```

### 6. Créer le Contrôleur

```php
// src/Controller/ProductsController.php
class ProductsController extends AppController
{
    public function add(CreateProductUseCase $useCase)
    {
        // Injection automatique
    }
}
```

## 📚 Ressources

- [Documentation CakePHP](https://book.cakephp.org/5/)
- [AdminLTE Documentation](https://adminlte.io/docs/)
- [Architecture Hexagonale](https://alistair.cockburn.us/hexagonal-architecture/)
- [Domain-Driven Design](https://martinfowler.com/bliki/DomainDrivenDesign.html)

## 🤝 Contribution

Les contributions sont les bienvenues ! N'hésitez pas à soumettre une Pull Request.

## 📄 Licence

Ce projet est un logiciel open-source sous licence [MIT](https://opensource.org/licenses/MIT).

## 🎓 Pour Commencer

1. **Page d'accueil** - Visualisez l'aperçu de l'architecture
2. **Gestion des Utilisateurs** - Explorez le flux complet du contrôleur au domaine
3. **Examinez le code** - Comprenez comment l'injection de dépendances et l'architecture hexagonale fonctionnent ensemble
4. **Créez votre propre fonctionnalité** - Suivez les modèles établis

## 💡 Avantages Clés

- **Testabilité** : La logique métier est indépendante du framework
- **Maintenabilité** : Séparation claire des responsabilités
- **Flexibilité** : Facile de changer d'implémentation (ex: changer d'ORM)
- **Évolutivité** : Code bien organisé qui grandit avec votre application
- **Collaboration en Équipe** : Frontières claires entre les couches

---

**Bon Développement ! 🚀**
