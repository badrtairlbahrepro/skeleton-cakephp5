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
                    <p>Ce guide explique <strong>comment tester votre code</strong> avec les outils installés dans le projet.</p>

                    <h4>🎯 Objectifs</h4>
                    <ul>
                        <li>✅ Comprendre pourquoi tester</li>
                        <li>✅ Savoir écrire des tests</li>
                        <li>✅ Utiliser les commandes de test</li>
                        <li>✅ Interpréter les résultats</li>
                    </ul>

                    <hr>

                    <h3><i class="fas fa-vial"></i> 1. PHPUnit - Les Tests</h3>
                    
                    <h4>Qu'est-ce que c'est ?</h4>
                    <p><strong>PHPUnit</strong> vérifie que votre code fonctionne correctement.</p>

                    <h5>Exemple simple :</h5>
                    <pre class="bg-dark text-light p-3 rounded"><code><?= h('// Votre fonction
function addition(int $a, int $b): int 
{
    return $a + $b;
}

// Test PHPUnit
public function testAddition(): void
{
    $result = addition(2, 3);
    $this->assertEquals(5, $result); // ✅ Ça marche !
}') ?></code></pre>

                    <h5>Pourquoi c'est important ?</h5>
                    <ul>
                        <li>✅ Vous savez immédiatement si quelque chose casse</li>
                        <li>✅ Vous pouvez modifier votre code en confiance</li>
                        <li>✅ Les tests sont comme une documentation vivante</li>
                    </ul>

                    <hr>

                    <h3><i class="fas fa-code"></i> 2. Comment Écrire un Test ?</h3>

                    <h4>Structure AAA (Arrange-Act-Assert)</h4>
                    <p><strong>Chaque test suit ces 3 étapes :</strong></p>

                    <pre class="bg-dark text-light p-3 rounded"><code><?= h('public function testCreateUser(): void
{
    // 🎯 ARRANGE - Préparer les données
    $email = \'john@example.com\';
    $name = \'John Doe\';
    
    // ⚡ ACT - Exécuter le code à tester
    $user = new User($email, $name);
    
    // ✅ ASSERT - Vérifier le résultat
    $this->assertEquals($email, $user->getEmail());
    $this->assertEquals($name, $user->getName());
}') ?></code></pre>

                    <hr>

                    <h3><i class="fas fa-folder"></i> 3. Les Tests Existants</h3>

                    <h4>Fichiers de Test Disponibles</h4>
                    <pre class="bg-dark text-light p-3 rounded"><code><?= h('tests/TestCase/
├── Domain/
│   └── User/
│       └── Entity/
│           └── UserTest.php              # 13 tests
├── Application/
│   └── UseCases/
│       └── User/
│           ├── CreateUserUseCaseTest.php  # 6 tests
│           └── GetUserUseCaseTest.php     # 6 tests') ?></code></pre>

                    <p><strong>Total : 25 tests, 65 assertions</strong></p>

                    <hr>

                    <h3><i class="fas fa-terminal"></i> 4. Lancer les Tests</h3>

                    <h4>Commandes de Base</h4>
                    <pre class="bg-dark text-light p-3 rounded"><code><?= h('# Tous les tests
./vendor/bin/phpunit tests/TestCase/ --testdox

# Un dossier spécifique
./vendor/bin/phpunit tests/TestCase/Domain/ --testdox

# Un fichier spécifique
./vendor/bin/phpunit tests/TestCase/Domain/User/Entity/UserTest.php --testdox

# Une méthode spécifique
./vendor/bin/phpunit --filter testCreateUserWithValidData

# S\'arrêter au premier échec
./vendor/bin/phpunit tests/ --stop-on-failure') ?></code></pre>

                    <hr>

                    <h3><i class="fas fa-chart-line"></i> 5. Interpréter les Résultats</h3>

                    <h4>✅ Test Réussi</h4>
                    <pre class="bg-success text-white p-3 rounded"><code><?= h('✔ Create user with valid data
Time: 00:00.035
OK (1 test, 2 assertions)') ?></code></pre>
                    <p><strong>Signification :</strong> Tout fonctionne correctement.</p>

                    <h4>❌ Test Échoué</h4>
                    <pre class="bg-danger text-white p-3 rounded"><code><?= h('✘ Create user with valid data
Failed asserting that 2 matches expected 5.') ?></code></pre>
                    <p><strong>Signification :</strong> Le résultat obtenu (2) ne correspond pas à ce qui était attendu (5).</p>

                    <hr>

                    <h3><i class="fas fa-magic"></i> 6. Les Mocks</h3>

                    <h4>Qu'est-ce qu'un Mock ?</h4>
                    <p>Un <strong>mock</strong> est un objet factice qui simule le comportement d'un vrai objet.</p>

                    <h5>Pourquoi l'utiliser ?</h5>
                    <pre class="bg-dark text-light p-3 rounded"><code><?= h('Sans Mock: User → Repository → Database  ❌ Compliqué
Avec Mock:  User → Mock Repository        ✅ Simple et rapide') ?></code></pre>

                    <h5>Exemple avec Mock</h5>
                    <pre class="bg-dark text-light p-3 rounded"><code><?= h('protected function setUp(): void
{
    // Créer un mock du repository
    $this->repositoryMock = $this->createMock(UserRepositoryInterface::class);
    
    // Injecter le mock au use case
    $this->useCase = new CreateUserUseCase($this->repositoryMock);
}

public function testCreateUser(): void
{
    // Configurer le mock
    $this->repositoryMock
        ->expects($this->once())        // Combien de fois ?
        ->method(\'findByEmail\')         // Quelle méthode ?
        ->with(\'john@example.com\')      // Avec quels paramètres ?
        ->willReturn(null);             // Quel résultat ?
    
    // Exécuter le code
    $result = $this->useCase->execute(\'john@example.com\', \'John\');
}') ?></code></pre>

                    <hr>

                    <h3><i class="fas fa-lightbulb"></i> 7. Bonnes Pratiques</h3>

                    <h4>✅ À Faire</h4>
                    <ol>
                        <li><strong>Nommer clairement les tests</strong>
                            <pre class="bg-dark text-light p-2 rounded"><code><?= h('testCreateUserWithValidData()
testUserWithInvalidEmail()') ?></code></pre>
                        </li>
                        <li><strong>Un test = Un comportement</strong>
                            <pre class="bg-dark text-light p-2 rounded"><code><?= h('testEmailValidation()  // Teste SEULEMENT l\'email
testNameValidation()   // Teste SEULEMENT le nom') ?></code></pre>
                        </li>
                        <li><strong>Utiliser le pattern AAA</strong>
                            <ul>
                                <li><strong>Arrange</strong> : Préparer</li>
                                <li><strong>Act</strong> : Exécuter</li>
                                <li><strong>Assert</strong> : Vérifier</li>
                            </ul>
                        </li>
                    </ol>

                    <h4>❌ À Éviter</h4>
                    <ol>
                        <li>Tests qui dépendent d'autres tests</li>
                        <li>Accès à la base de données réelle</li>
                        <li>Trop de mocks</li>
                        <li>Données bizarres</li>
                    </ol>

                    <hr>

                    <h3><i class="fas fa-check-circle"></i> Résumé</h3>
                    <div class="alert alert-success">
                        <ul class="mb-0">
                            <li>✅ <strong>25 tests</strong> couvrant le code</li>
                            <li>✅ <strong>Pattern AAA</strong> pour structure claire</li>
                            <li>✅ <strong>Mocks</strong> pour isoler les dépendances</li>
                            <li>✅ <strong>100% de réussite</strong> actuel</li>
                        </ul>
                    </div>

                    <p>Pour plus de détails, consultez <code>TESTING.md</code> et <code>TESTS_QUICKSTART.md</code></p>
                </div>
            </div>
        </div>
    </div>
</div>

