<?php
/**
 * Guide d'Injection de Dépendances
 */
$this->assign('title', 'Guide Injection de Dépendances');
?>

<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-plug mr-2"></i>
                    Injection de Dépendances (DI) - Guide Complet
                </h3>
            </div>
            <div class="card-body">
                <h4>Qu'est-ce que l'Injection de Dépendances?</h4>
                <p>L'injection de dépendances consiste à passer les dépendances à une classe plutôt que de les créer en interne. Cela rend le code testable, flexible et maintenable.</p>

                <div class="alert alert-info">
                    <strong>Concept Clé:</strong> Au lieu de coder en dur les dépendances, passez-les en tant que paramètres.
                </div>

                <hr>

                <h4>Bénéfices de l'Injection de Dépendances</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <h5>✅ Testabilité</h5>
                            </div>
                            <div class="card-body">Facile de simuler les dépendances dans les tests unitaires</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <h5>✅ Flexibilité</h5>
                            </div>
                            <div class="card-body">Échangez les implémentations sans modifier le code</div>
                        </div>
                    </div>
                </div>

                <hr>

                <h4>Sans Injection de Dépendances (❌ Mauvais)</h4>
                <pre class="bg-light p-3" style="border: 1px solid #ddd; border-radius: 4px;"><code>class CreateUserUseCase {
    public function __construct() {
        $this->repository = new UserRepository(); // ❌ Codé en dur
    }
}</code></pre>

                <h4>Avec Injection de Dépendances (✅ Bon)</h4>
                <pre class="bg-light p-3" style="border: 1px solid #ddd; border-radius: 4px;"><code>class CreateUserUseCase {
    public function __construct(UserRepositoryInterface $repository) {
        $this->repository = $repository; // ✅ Injecté
    }
}</code></pre>

                <hr>

                <h4>ServiceProvider: Enregistrement des Dépendances</h4>
                <p>Le <code>ServiceProvider</code> gère tous les enregistrements de dépendances:</p>
                <pre class="bg-light p-3" style="border: 1px solid #ddd; border-radius: 4px;"><code>// src/Infrastructure/DependencyInjection/ServiceProvider.php

class ServiceProvider {
    public function register(ContainerInterface $container): void {
        // Mapper interface à implémentation
        $container->add(
            UserRepositoryInterface::class, 
            UserRepository::class
        );

        // Enregistrer cas d'usage avec dépendances
        $container->add(CreateUserUseCase::class)
            ->addArgument(UserRepositoryInterface::class);
    }
}</code></pre>

                <hr>

                <h4>5 Étapes: Comment Utiliser</h4>

                <ol>
                    <li><strong>Définir l'Interface:</strong>
                        <pre class="bg-light p-2" style="border: 1px solid #ddd; margin-top: 5px;"><code>interface UserRepositoryInterface {
    public function findById(int $id): ?User;
    public function save(User $user): void;
}</code></pre>
                    </li>

                    <li><strong>Implémenter l'Interface:</strong>
                        <pre class="bg-light p-2" style="border: 1px solid #ddd; margin-top: 5px;"><code>class UserRepository implements UserRepositoryInterface {
    public function findById(int $id): ?User { ... }
    public function save(User $user): void { ... }
}</code></pre>
                    </li>

                    <li><strong>Créer Cas d'Usage avec DI:</strong>
                        <pre class="bg-light p-2" style="border: 1px solid #ddd; margin-top: 5px;"><code>class CreateUserUseCase {
    public function __construct(
        private UserRepositoryInterface $repository
    ) {}

    public function execute(array $data): User {
        $user = new User($data);
        $this->repository->save($user);
        return $user;
    }
}</code></pre>
                    </li>

                    <li><strong>Enregistrer dans ServiceProvider:</strong>
                        <pre class="bg-light p-2" style="border: 1px solid #ddd; margin-top: 5px;"><code>$container->add(CreateUserUseCase::class)
    ->addArgument(UserRepositoryInterface::class);</code></pre>
                    </li>

                    <li><strong>Utiliser dans Contrôleur (Auto-Injecté):</strong>
                        <pre class="bg-light p-2" style="border: 1px solid #ddd; margin-top: 5px;"><code>class UsersController extends AppController {
    public function add(CreateUserUseCase $useCase) {
        // Automatiquement injecté!
        $result = $useCase->execute($data);
    }
}</code></pre>
                    </li>
                </ol>

                <hr>

                <h4>Ajouter Nouvelles Dépendances</h4>
                <p>Exemple: Ajouter un Service de Notification</p>

                <div class="card card-outline card-warning">
                    <div class="card-header">
                        <h5>Étape par Étape</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>1. Créer l'Interface:</strong></p>
                        <pre class="bg-light p-2" style="border: 1px solid #ddd;"><code>interface NotificationInterface {
    public function send(string $email, string $message): void;
}</code></pre>

                        <p style="margin-top: 10px;"><strong>2. L'Implémenter:</strong></p>
                        <pre class="bg-light p-2" style="border: 1px solid #ddd;"><code>class EmailNotification implements NotificationInterface {
    public function send(string $email, string $message): void {
        // Envoyer email
    }
}</code></pre>

                        <p style="margin-top: 10px;"><strong>3. Enregistrer dans ServiceProvider:</strong></p>
                        <pre class="bg-light p-2" style="border: 1px solid #ddd;"><code>$container->add(NotificationInterface::class, EmailNotification::class);</code></pre>

                        <p style="margin-top: 10px;"><strong>4. Mettre à Jour Cas d'Usage:</strong></p>
                        <pre class="bg-light p-2" style="border: 1px solid #ddd;"><code>class CreateUserUseCase {
    public function __construct(
        UserRepositoryInterface $repository,
        NotificationInterface $notification  // Nouvelle!
    ) {}
}</code></pre>

                        <p style="margin-top: 10px;"><strong>5. Mettre à Jour ServiceProvider:</strong></p>
                        <pre class="bg-light p-2" style="border: 1px solid #ddd;"><code>$container->add(CreateUserUseCase::class)
    ->addArgument(UserRepositoryInterface::class)
    ->addArgument(NotificationInterface::class);  // Ajouter dépendance!</code></pre>
                    </div>
                </div>

                <hr>

                <h4>Tester avec DI</h4>
                <p>Un des plus grands bénéfices - simulation facile:</p>
                <pre class="bg-light p-3" style="border: 1px solid #ddd; border-radius: 4px;"><code>public function testCreateUser() {
    // Créer une simulation
    $mockRepo = $this->createMock(UserRepositoryInterface::class);
    $mockRepo->expects($this->once())->method('save');

    // Passer la simulation
    $useCase = new CreateUserUseCase($mockRepo);
    $result = $useCase->execute(['email' => 'test@example.com']);

    $this->assertNotEmpty($result->id);
}</code></pre>

                <hr>

                <h4>Référence Rapide</h4>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Pattern</th>
                                <th>Code</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Simple</td>
                                <td><code>$container->add(MyService::class);</code></td>
                            </tr>
                            <tr>
                                <td>Interface → Implémentation</td>
                                <td><code>$container->add(Interface::class, Implementation::class);</code></td>
                            </tr>
                            <tr>
                                <td>Avec Dépendances</td>
                                <td><code>$container->add(MyClass::class)->addArgument(Dep::class);</code></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <hr>

                <div class="alert alert-success">
                    <h5><i class="fas fa-check-circle"></i> Résumé</h5>
                    <ul>
                        <li>✅ DI rend le code testable et flexible</li>
                        <li>✅ Utilisez toujours les interfaces pour les contrats</li>
                        <li>✅ Enregistrez les dépendances dans ServiceProvider</li>
                        <li>✅ CakePHP injecte automatiquement lors du type-hint</li>
                        <li>✅ Ceci suit les principes d'architecture hexagonale</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
