<?php
/**
 * Test Guide Page
 * Complete guide for testing
 */
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2><i class="fas fa-book"></i> Guide Complet des Tests</h2>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <a href="/pages" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Retour à l'accueil
                        </a>
                    </div>

                    <hr>

                    <h3><i class="fas fa-flask"></i> Introduction</h3>
                    <p>Ce guide présente les <strong>bonnes pratiques de test</strong> et les outils disponibles dans le projet.</p>

                    <h4>Objectifs</h4>
                    <ul>
                        <li>✅ Comprendre les principes du test unitaire</li>
                        <li>✅ Maîtriser l'écriture de tests PHPUnit</li>
                        <li>✅ Utiliser les commandes de test appropriées</li>
                        <li>✅ Interpréter les résultats et les rapports de couverture</li>
                    </ul>

                    <hr>

                    <h3><i class="fas fa-vial"></i> 1. PHPUnit - Framework de Tests</h3>
                    
                    <h4>Présentation</h4>
                    <p><strong>PHPUnit</strong> est le framework de référence pour l'exécution de tests unitaires en PHP. Il permet de valider le comportement attendu du code.</p>

                    <h5>Exemple d'implémentation :</h5>
                    <pre class="bg-dark text-light p-3 rounded"><code><?= h('// Fonction métier
function addition(int $a, int $b): int 
{
    return $a + $b;
}

// Test PHPUnit
public function testAddition(): void
{
    $result = addition(2, 3);
    $this->assertEquals(5, $result);
}') ?></code></pre>

                    <h5>Avantages du test automatisé :</h5>
                    <ul>
                        <li>✅ Détection immédiate des régressions</li>
                        <li>✅ Refactoring sécurisé avec validation continue</li>
                        <li>✅ Documentation exécutable du comportement attendu</li>
                    </ul>

                    <hr>

                    <h3><i class="fas fa-code"></i> 2. Structure d'un Test</h3>

                    <h4>Pattern AAA (Arrange-Act-Assert)</h4>
                    <p><strong>Chaque test suit obligatoirement cette structure en trois phases :</strong></p>

                    <pre class="bg-dark text-light p-3 rounded"><code><?= h('public function testCreateUser(): void
{
    // ARRANGE - Préparation des données de test
    $email = \'john@example.com\';
    $name = \'John Doe\';
    
    // ACT - Exécution du code sous test
    $user = new User($email, $name);
    
    // ASSERT - Vérification des résultats attendus
    $this->assertEquals($email, $user->getEmail());
    $this->assertEquals($name, $user->getName());
}') ?></code></pre>

                    <hr>

                    <h3><i class="fas fa-folder"></i> 3. Architecture des Tests</h3>

                    <h4>Structure des Fichiers de Test</h4>
                    <pre class="bg-dark text-light p-3 rounded"><code><?= h('tests/TestCase/
├── Domain/
│   └── User/
│       └── Entity/
│           └── UserTest.php              # 13 cas de test
├── Application/
│   └── UseCases/
│       └── User/
│           ├── CreateUserUseCaseTest.php  # 6 cas de test
│           └── GetUserUseCaseTest.php     # 6 cas de test') ?></code></pre>

                    <p><strong>Métriques : 25 tests, 65 assertions au total</strong></p>

                    <hr>

                    <h3><i class="fas fa-terminal"></i> 4. Exécution des Tests</h3>

                    <h4>Commandes Disponibles</h4>
                    <pre class="bg-dark text-light p-3 rounded"><code><?= h('# Exécuter toute la suite de tests
./vendor/bin/phpunit tests/TestCase/ --testdox

# Exécuter les tests d\'un domaine spécifique
./vendor/bin/phpunit tests/TestCase/Domain/ --testdox

# Exécuter un fichier de test spécifique
./vendor/bin/phpunit tests/TestCase/Domain/User/Entity/UserTest.php --testdox

# Exécuter une méthode de test spécifique
./vendor/bin/phpunit --filter testCreateUserWithValidData

# Arrêter l\'exécution dès le premier échec
./vendor/bin/phpunit tests/ --stop-on-failure') ?></code></pre>

                    <hr>

                    <h3><i class="fas fa-chart-line"></i> 5. Interprétation des Résultats</h3>

                    <h4>✅ Cas de Test Réussi</h4>
                    <pre class="bg-success text-white p-3 rounded"><code><?= h('✔ Create user with valid data
Time: 00:00.035
OK (1 test, 2 assertions)') ?></code></pre>
                    <p><strong>Interprétation :</strong> Le test a validé toutes les assertions. Le code répond aux attentes.</p>

                    <h4>❌ Cas de Test Échoué</h4>
                    <pre class="bg-danger text-white p-3 rounded"><code><?= h('✘ Create user with valid data
Failed asserting that 2 matches expected 5.') ?></code></pre>
                    <p><strong>Interprétation :</strong> La valeur obtenue (2) diffère de la valeur attendue (5). Défaillance détectée dans la logique métier.</p>

                    <hr>

                    <h3><i class="fas fa-magic"></i> 6. Objets de Simulation (Mocks)</h3>

                    <h4>Définition</h4>
                    <p>Un <strong>mock</strong> est un objet de test qui simule le comportement d'une dépendance externe, permettant l'isolation du code sous test.</p>

                    <h5>Intérêt de l'utilisation</h5>
                    <pre class="bg-dark text-light p-3 rounded"><code><?= h('Sans Mock: User → Repository → Database  ❌ Couplage fort
Avec Mock:  User → Mock Repository        ✅ Isolation complète') ?></code></pre>

                    <h5>Exemple d'implémentation</h5>
                    <pre class="bg-dark text-light p-3 rounded"><code><?= h('protected function setUp(): void
{
    // Création d\'un mock du repository
    $this->repositoryMock = $this->createMock(UserRepositoryInterface::class);
    
    // Injection du mock dans le use case
    $this->useCase = new CreateUserUseCase($this->repositoryMock);
}

public function testCreateUser(): void
{
    // Configuration du comportement du mock
    $this->repositoryMock
        ->expects($this->once())        // Nombre d\'appels attendus
        ->method(\'findByEmail\')         // Méthode à simuler
        ->with(\'john@example.com\')      // Paramètres attendus
        ->willReturn(null);             // Valeur de retour
    
    // Exécution du use case
    $result = $this->useCase->execute(\'john@example.com\', \'John\');
}') ?></code></pre>

                    <hr>

                    <h3><i class="fas fa-lightbulb"></i> 7. Bonnes Pratiques</h3>

                    <h4>✅ Recommandations</h4>
                    <ol>
                        <li><strong>Nommage explicite des méthodes de test</strong>
                            <pre class="bg-dark text-light p-2 rounded"><code><?= h('testCreateUserWithValidData()
testCreateUserWithInvalidEmail()') ?></code></pre>
                        </li>
                        <li><strong>Principe d'unicité : un test = un comportement</strong>
                            <pre class="bg-dark text-light p-2 rounded"><code><?= h('testEmailValidation()  // Valide uniquement l\'email
testNameValidation()   // Valide uniquement le nom') ?></code></pre>
                        </li>
                        <li><strong>Respect du pattern AAA (Arrange-Act-Assert)</strong>
                            <ul>
                                <li><strong>Arrange</strong> : Préparation des données</li>
                                <li><strong>Act</strong> : Exécution du code</li>
                                <li><strong>Assert</strong> : Vérification des résultats</li>
                            </ul>
                        </li>
                    </ol>

                    <h4>❌ Anti-Patterns</h4>
                    <ol>
                        <li>Tests interdépendants créant des dépendances implicites</li>
                        <li>Exécution sur base de données de production</li>
                        <li>Utilisation excessive de mocks nuisant à la lisibilité</li>
                        <li>Données de test non représentatives ou aléatoires</li>
                    </ol>

                    <hr>

                    <h3><i class="fas fa-check-circle"></i> Résumé</h3>
                    <div class="alert alert-success">
                        <ul class="mb-0">
                            <li>✅ <strong>25 tests</strong> assurant la couverture du code</li>
                            <li>✅ <strong>Pattern AAA</strong> pour une structure claire et maintenable</li>
                            <li>✅ <strong>Mocks</strong> pour isolation des dépendances</li>
                            <li>✅ <strong>100% de réussite</strong> dans l'état actuel</li>
                        </ul>
                    </div>

                    <p>Pour approfondir, consultez les documents <code>TESTING.md</code> et <code>TESTING_GUIDE.md</code> dans le dossier <code>docs/</code></p>
                </div>
            </div>
        </div>
    </div>
</div>

