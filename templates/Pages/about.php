<?php
/**
 * Page À propos
 *
 * @var \App\View\AppView $this
 */
$this->assign('title', 'À Propos de ce Projet');
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle mr-2"></i>
                    À propos de l'Architecture Hexagonale
                </h3>
            </div>
            <div class="card-body">
                <h4>Qu'est-ce que l'Architecture Hexagonale?</h4>
                <p>
                    L'Architecture Hexagonale, également connue sous le nom de <strong>Ports et Adaptateurs</strong>, est un pattern d'architecture
                    qui vise à créer des composants d'application faiblement couplés qui peuvent être facilement connectés à leur
                    environnement logiciel au moyen de ports et d'adaptateurs.
                </p>

                <h5 class="mt-4">Concepts Clés:</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="info-box bg-info">
                            <span class="info-box-icon"><i class="fas fa-plug"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Ports</span>
                                <span class="info-box-number">Interfaces définissant des contrats</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box bg-success">
                            <span class="info-box-icon"><i class="fas fa-exchange-alt"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Adaptateurs</span>
                                <span class="info-box-number">Implémentations concrètes</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box bg-warning">
                            <span class="info-box-icon"><i class="fas fa-gem"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Domaine</span>
                                <span class="info-box-number">Logique métier pure</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-check-circle mr-2"></i>
                    Bénéfices
                </h3>
            </div>
            <div class="card-body">
                <ul>
                    <li><strong>Testabilité:</strong> La logique métier peut être testée sans dépendances externes</li>
                    <li><strong>Maintenabilité:</strong> La séparation claire facilite la compréhension et la modification du code</li>
                    <li><strong>Flexibilité:</strong> Facile d'échanger les implémentations (bases de données, APIs, etc.)</li>
                    <li><strong>Indépendance:</strong> La logique métier principale est indépendante du framework</li>
                    <li><strong>Scalabilité:</strong> Code bien organisé qui grandit avec votre application</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-layer-group mr-2"></i>
                    Domain-Driven Design
                </h3>
            </div>
            <div class="card-body">
                <p><strong>DDD</strong> est une approche du développement logiciel qui centre le développement sur la programmation d'un modèle de domaine ayant une riche compréhension des processus et des règles d'un domaine.</p>
                
                <h6 class="mt-3">Patterns Clés:</h6>
                <ul>
                    <li><strong>Entités:</strong> Objets avec identité et cycle de vie</li>
                    <li><strong>Objets Valeur:</strong> Objets immuables sans identité</li>
                    <li><strong>Dépôts:</strong> Abstraction pour l'accès aux données</li>
                    <li><strong>Cas d'Usage:</strong> Règles métier spécifiques à l'application</li>
                    <li><strong>Services Métier:</strong> Opérations sans état</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-code mr-2"></i>
                    Structure du Projet
                </h3>
            </div>
            <div class="card-body">
                <pre class="bg-light p-3"><code>src/
├── Domain/                    # Logique Métier (Couche Interne)
│   └── User/
│       ├── Entity/           # Objets de domaine riches
│       │   └── User.php
│       └── Repository/       # Ports (interfaces)
│           └── UserRepositoryInterface.php
│
├── Application/              # Cas d'Usage (Couche Intermédiaire)
│   └── UseCases/
│       └── User/
│           ├── CreateUserUseCase.php
│           └── GetUserUseCase.php
│
└── Infrastructure/           # Adaptateurs (Couche Externe)
    ├── DependencyInjection/
    │   └── ServiceProvider.php
    └── Persistence/
        └── CakeOrm/
            ├── UserRepository.php      # Implémentation adaptateur
            └── Table/
                └── UsersTable.php      # ORM CakePHP</code></pre>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-graduation-cap mr-2"></i>
                    En Savoir Plus
                </h3>
            </div>
            <div class="card-body">
                <p>Pour en savoir plus sur l'architecture et les détails de mise en œuvre, consultez:</p>
                <ul>
                    <li><?= $this->Html->link('README.md', '#', ['target' => '_blank']) ?> - Guide de démarrage rapide</li>
                    <li><?= $this->Html->link('ARCHITECTURE.md', '#', ['target' => '_blank']) ?> - Documentation d'architecture détaillée</li>
                    <li><?= $this->Html->link('Exemple Utilisateurs', ['controller' => 'Users', 'action' => 'index']) ?> - Voir l'architecture en action</li>
                </ul>

                <div class="alert alert-info mt-3">
                    <h5><i class="icon fas fa-info"></i> Prochaines Étapes</h5>
                    <p>Essayez de créer votre propre fonctionnalité en suivant le pattern d'architecture hexagonale:</p>
                    <ol>
                        <li>Définissez votre entité de domaine</li>
                        <li>Créez une interface de dépôt (port)</li>
                        <li>Implémentez un cas d'usage</li>
                        <li>Créez l'adaptateur de dépôt</li>
                        <li>Enregistrez les services dans le conteneur DI</li>
                        <li>Construisez votre contrôleur et vos vues</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
