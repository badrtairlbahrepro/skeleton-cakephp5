<?php
/**
 * Quality Tools Guide Page
 * Complete guide for quality tools
 */
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h2><i class="fas fa-tools"></i> Guide des Outils de Qualité</h2>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <a href="/pages" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Retour à l'accueil
                        </a>
                    </div>

                    <hr>

                    <h3><i class="fas fa-star"></i> Introduction</h3>

                    <h4>Objectifs des Outils de Qualité</h4>
                    <p>Les outils de qualité de code assurent la maintenance, la robustesse et la maintenabilité d'une application. Ils garantissent que le code source respecte les standards de l'industrie et fonctionne comme prévu.</p>
                    
                    <p>Ces outils permettent de :</p>
                    <ul>
                        <li>✅ Valider le comportement attendu du code (tests unitaires et d'intégration)</li>
                        <li>✅ Détecter les erreurs potentielles avant leur apparition en production (analyse statique)</li>
                        <li>✅ Maintenir un style de code cohérent et lisible (formatage et linting)</li>
                        <li>✅ Respecter les standards de l'industrie et améliorer la collaboration (PSR-12)</li>
                    </ul>

                    <hr>

                    <h3><i class="fas fa-vial"></i> 1. PHPUnit - Tests Automatisés</h3>

                    <p><strong>Fonction :</strong> Framework de tests pour valider la conformité fonctionnelle du code.</p>

                    <h5>Exemple d'implémentation :</h5>
                    <pre class="bg-dark text-light p-3 rounded"><code><?= h('// Code métier
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

                    <h5>Avantages :</h5>
                    <ul>
                        <li>Détection immédiate des régressions lors des modifications</li>
                        <li>Confiance accrue lors du refactoring</li>
                        <li>Documentation vivante du comportement attendu</li>
                    </ul>

                    <hr>

                    <h3><i class="fas fa-search"></i> 2. PHPStan - Analyse Statique</h3>

                    <p><strong>Fonction :</strong> Détection proactive d'erreurs potentielles par analyse statique du code source.</p>

                    <h5>Exemple de détection :</h5>
                    <pre class="bg-danger text-white p-3 rounded"><code><?= h('// ❌ Code problématique
function divide($a, $b) 
{
    return $a / $b; // Division sans validation de $b
}') ?></code></pre>

                    <pre class="bg-success text-white p-3 rounded"><code><?= h('// ✅ Code corrigé
function divide(int $a, int $b): int 
{
    if ($b === 0) {
        throw new InvalidArgumentException(\'Division par zéro interdite\');
    }
    return $a / $b;
}') ?></code></pre>

                    <h5>Bénéfices :</h5>
                    <ul>
                        <li>Identification précoce de vulnérabilités et erreurs logiques</li>
                        <li>Encouragement à l'écriture de code type-safe et robuste</li>
                        <li>Réduction des incidents en environnement de production</li>
                    </ul>

                    <hr>

                    <h3><i class="fas fa-broom"></i> 3. PHP_CodeSniffer - Analyse de Style</h3>

                    <p><strong>Fonction :</strong> Application automatique de standards de codage (PSR-12) pour assurer la cohérence stylistique.</p>

                    <h5>Exemple de normalisation :</h5>
                    <pre class="bg-danger text-white p-3 rounded"><code><?= h('// ❌ Code non conforme
function test($a,$b){
return $a+$b;
}') ?></code></pre>

                    <pre class="bg-success text-white p-3 rounded"><code><?= h('// ✅ Code conforme PSR-12
function test(int $a, int $b): int
{
    return $a + $b;
}') ?></code></pre>

                    <h5>Intérêts :</h5>
                    <ul>
                        <li>Standardisation du style de code sur l'ensemble du projet</li>
                        <li>Amélioration de la lisibilité et de la maintenabilité</li>
                        <li>Facilitation de la collaboration en équipe</li>
                    </ul>

                    <hr>

                    <h3><i class="fas fa-cog"></i> 4. Configuration</h3>

                    <h4>Structure des Fichiers de Configuration</h4>
                    <pre class="bg-dark text-light p-3 rounded"><code><?= h('projet/
├── phpunit.xml.dist         → Configuration des tests unitaires
├── phpstan.neon            → Configuration de l\'analyse statique
├── phpstan-baseline.neon   → Exceptions connues à l\'analyse
├── .php-cs-fixer.dist.php  → Configuration du formatage
└── composer.json            → Scripts et dépendances du projet') ?></code></pre>

                    <hr>

                    <h3><i class="fas fa-play"></i> 5. Utilisation</h3>

                    <h4>Commandes Disponibles</h4>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Commande</th>
                                <th>Cas d'usage</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><code>composer test</code></td>
                                <td>Avant chaque commit</td>
                                <td>Exécution de la suite de tests PHPUnit</td>
                            </tr>
                            <tr>
                                <td><code>composer stan</code></td>
                                <td>Après modification du code</td>
                                <td>Analyse statique du code source</td>
                            </tr>
                            <tr>
                                <td><code>composer cs-check</code></td>
                                <td>Avant chaque commit</td>
                                <td>Vérification de conformité au standard PSR-12</td>
                            </tr>
                            <tr>
                                <td><code>composer cs-fix</code></td>
                                <td>Après détection d'erreurs de style</td>
                                <td>Correction automatique du formatage</td>
                            </tr>
                            <tr>
                                <td><code>composer check</code></td>
                                <td>Avant chaque push</td>
                                <td>Exécution complète de tous les contrôles de qualité</td>
                            </tr>
                        </tbody>
                    </table>

                    <hr>

                    <h3><i class="fas fa-chart-bar"></i> État de la Qualité du Code</h3>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card border-primary">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-flask"></i> PHPUnit</h5>
                                    <p class="card-text">25 tests, 65 assertions</p>
                                    <p class="text-success"><strong>✅ 100% de réussite</strong></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-info">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-search"></i> PHPStan</h5>
                                    <p class="card-text">Niveau 8, 0 erreur</p>
                                    <p class="text-success"><strong>✅ Analyse sans anomalie</strong></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-success">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-broom"></i> CodeSniffer</h5>
                                    <p class="card-text">Standard PSR-12</p>
                                    <p class="text-success"><strong>✅ Conformité validée</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

