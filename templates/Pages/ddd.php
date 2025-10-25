<?php
/**
 * Page Domain-Driven Design
 */
$this->assign('title', 'Domain-Driven Design (DDD)');
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-layer-group mr-2"></i>
                    Domain-Driven Design (DDD) - Guide Complet
                </h3>
            </div>
            <div class="card-body">
                <h4>Qu'est-ce que le Domain-Driven Design?</h4>
                <p>Le <strong>Domain-Driven Design (DDD)</strong> est une approche du développement logiciel qui place l'accent sur la modélisation du domaine métier. Il propose que le code doit être étroitement aligné avec la logique métier et que le vocabulaire utilisé dans le code doit correspondre au vocabulaire du domaine.</p>

                <div class="alert alert-info">
                    <h5><i class="fas fa-lightbulb"></i> Concept Clé</h5>
                    <p>Le <strong>Domaine</strong> est le problème que vous résolvez. DDD place ce domaine au cœur du développement.</p>
                </div>

                <hr>

                <h4>Bénéfices du DDD</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <h5>✅ Clarté</h5>
                            </div>
                            <div class="card-body">Le code reflète directement la logique métier</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <h5>✅ Communication</h5>
                            </div>
                            <div class="card-body">Vocabulaire commun entre développeurs et métier</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <h5>✅ Maintenabilité</h5>
                            </div>
                            <div class="card-body">Plus facile à modifier et à étendre</div>
                        </div>
                    </div>
                </div>

                <hr>

                <h4>Les 4 Éléments Essentiels du DDD</h4>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h5><i class="fas fa-cube"></i> Entités (Entities)</h5>
                            </div>
                            <div class="card-body">
                                <p>Objets avec une <strong>identité unique</strong> et un <strong>cycle de vie</strong>.</p>
                                <pre class="bg-light p-2" style="border: 1px solid #ddd;"><code>class User {
    private int $id;
    private string $email;
    private string $name;
}</code></pre>
                                <p class="mt-2"><small>✓ Même si deux utilisateurs ont le même nom, ils restent des entités différentes grâce à leur ID.</small></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card card-info">
                            <div class="card-header">
                                <h5><i class="fas fa-gem"></i> Objets Valeur (Value Objects)</h5>
                            </div>
                            <div class="card-body">
                                <p>Objets <strong>immuables</strong> sans identité propre.</p>
                                <pre class="bg-light p-2" style="border: 1px solid #ddd;"><code>class Email {
    private string $value;
    
    public function __construct(string $value) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException();
        }
        $this->value = $value;
    }
}</code></pre>
                                <p class="mt-2"><small>✓ Deux emails avec la même valeur sont équivalents.</small></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="card card-warning">
                            <div class="card-header">
                                <h5><i class="fas fa-database"></i> Dépôts (Repositories)</h5>
                            </div>
                            <div class="card-body">
                                <p>Abstraction pour l'<strong>accès aux données</strong> (Ports).</p>
                                <pre class="bg-light p-2" style="border: 1px solid #ddd;"><code>interface UserRepositoryInterface {
    public function findById(int $id): ?User;
    public function save(User $user): void;
    public function delete(User $user): void;
}</code></pre>
                                <p class="mt-2"><small>✓ Le domaine ne connaît pas comment les données sont stockées.</small></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h5><i class="fas fa-cogs"></i> Services du Domaine (Domain Services)</h5>
                            </div>
                            <div class="card-body">
                                <p>Opérations <strong>sans état</strong> du domaine.</p>
                                <pre class="bg-light p-2" style="border: 1px solid #ddd;"><code>class UserAuthService {
    public function authenticate(
        string $email, 
        string $password
    ): bool {
        // Logique d'authentification
    }
}</code></pre>
                                <p class="mt-2"><small>✓ Logique qui n'appartient pas à une entité spécifique.</small></p>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <h4>Patterns Additionnels du DDD</h4>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-outline card-secondary">
                            <div class="card-header">
                                <h5>Agrégats (Aggregates)</h5>
                            </div>
                            <div class="card-body">
                                <p>Groupe d'entités et de value objects liées qui forment une unité cohésive.</p>
                                <pre class="bg-light p-2" style="border: 1px solid #ddd;"><code>class Order {
    private int $id;
    private User $user;
    private array $items;
    
    public function addItem(OrderItem $item) {
        $this->items[] = $item;
    }
}</code></pre>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card card-outline card-secondary">
                            <div class="card-header">
                                <h5>Usines (Factories)</h5>
                            </div>
                            <div class="card-body">
                                <p>Responsables de créer des objets complexes du domaine.</p>
                                <pre class="bg-light p-2" style="border: 1px solid #ddd;"><code>class UserFactory {
    public function create(
        string $email, 
        string $name
    ): User {
        return new User(
            $email,
            $name
        );
    }
}</code></pre>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <h4>Langage Omniprésent (Ubiquitous Language)</h4>
                <p>Le concept le plus important du DDD est que les <strong>développeurs, les analystes métier et les utilisateurs doivent partager le même vocabulaire</strong>.</p>

                <div class="alert alert-success">
                    <h5><i class="fas fa-check-circle"></i> Exemple</h5>
                    <p>Si le domaine parle de "Panier" (Cart), le code doit aussi avoir une classe <code>Cart</code>, pas <code>ShoppingBag</code> ou <code>Basket</code>.</p>
                </div>

                <hr>

                <h4>Structure du Projet DDD</h4>
                <pre class="bg-light p-3" style="border: 1px solid #ddd;"><code>src/
├── Domain/                    # Logique Métier Pure
│   └── User/
│       ├── Entity/
│       │   └── User.php       # Entité du domaine
│       ├── ValueObject/
│       │   └── Email.php      # Objet valeur
│       ├── Repository/
│       │   └── UserRepositoryInterface.php  # Port
│       └── Service/
│           └── UserAuthService.php  # Service du domaine
│
├── Application/               # Orchestration
│   └── UseCases/
│       └── User/
│           ├── CreateUserUseCase.php
│           └── GetUserUseCase.php
│
└── Infrastructure/            # Implémentation Technique
    ├── Persistence/
    │   └── CakeOrm/
    │       └── UserRepository.php  # Adaptateur
    └── DependencyInjection/
        └── ServiceProvider.php</code></pre>

                <hr>

                <h4>Étapes pour Implémenter le DDD</h4>
                <ol>
                    <li><strong>Comprendre le Domaine</strong> - Collaborez avec les experts métier</li>
                    <li><strong>Définir le Langage Ubiquitaire</strong> - Créez un vocabulaire commun</li>
                    <li><strong>Modéliser les Entités</strong> - Créez les objets du domaine</li>
                    <li><strong>Créer les Value Objects</strong> - Identifiez les objets sans identité</li>
                    <li><strong>Définir les Dépôts</strong> - Abstraire l'accès aux données</li>
                    <li><strong>Implémenter les Cas d'Usage</strong> - Orchestrer les opérations</li>
                    <li><strong>Tester la Logique Métier</strong> - Les tests reflètent le domaine</li>
                </ol>

                <hr>

                <h4>Exemple Complet: Gestion d'Utilisateurs</h4>

                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h5>Domaine</h5>
                    </div>
                    <div class="card-body">
                        <pre class="bg-light p-2" style="border: 1px solid #ddd;"><code>// Entity
class User {
    private int $id;
    private Email $email;
    private string $name;
    
    public function __construct(Email $email, string $name) {
        $this->email = $email;
        $this->name = $name;
    }
}

// Value Object
class Email {
    private string $value;
    
    public function __construct(string $value) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException();
        }
        $this->value = $value;
    }
}

// Repository Interface
interface UserRepositoryInterface {
    public function save(User $user): void;
    public function findById(int $id): ?User;
}</code></pre>
                    </div>
                </div>

                <hr>

                <div class="alert alert-info">
                    <h5><i class="fas fa-info-circle"></i> À Retenir</h5>
                    <ul>
                        <li>✅ DDD place le domaine métier au cœur du développement</li>
                        <li>✅ Le vocabulaire du code doit correspondre au vocabulaire du domaine</li>
                        <li>✅ Séparez clairement le domaine, l'application et l'infrastructure</li>
                        <li>✅ Utilisez des entités pour les objets avec identité</li>
                        <li>✅ Utilisez des value objects pour les concepts immuables</li>
                        <li>✅ Les dépôts abstraient l'accès aux données</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
