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

                    <h4>Pourquoi des Outils de Qualité ?</h4>
                    <p>Imagine que vous construisez une maison. Vous ne vous contentez pas de la construire, vous vérifiez aussi que :</p>
                    <ul>
                        <li>Les murs sont droits</li>
                        <li>Les portes ferment bien</li>
                        <li>L'électricité fonctionne</li>
                        <li>Le toit ne fuit pas</li>
                    </ul>

                    <p>C'est pareil pour le code ! Les outils de qualité vérifient que votre code :</p>
                    <ul>
                        <li>✅ Fonctionne correctement (tests)</li>
                        <li>✅ Respecte les bonnes pratiques (style)</li>
                        <li>✅ N'a pas d'erreurs cachées (analyse statique)</li>
                        <li>✅ Est facile à comprendre (bonne organisation)</li>
                    </ul>

                    <hr>

                    <h3><i class="fas fa-vial"></i> 1. PHPUnit - Les Tests</h3>

                    <p><strong>Rôle :</strong> Vérifie que votre code fait bien ce qu'il doit faire.</p>

                    <h5>Exemple :</h5>
                    <pre class="bg-dark text-light p-3 rounded"><code><?= h('// Votre code
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
                        <li>Vous savez immédiatement si quelque chose casse</li>
                        <li>Vous pouvez modifier votre code en confiance</li>
                        <li>Les tests sont comme une documentation vivante</li>
                    </ul>

                    <hr>

                    <h3><i class="fas fa-search"></i> 2. PHPStan - L'Analyseur Statique</h3>

                    <p><strong>Rôle :</strong> Trouve les erreurs AVANT de lancer votre code.</p>

                    <h5>Exemple :</h5>
                    <pre class="bg-danger text-white p-3 rounded"><code><?= h('// ❌ Problème détecté par PHPStan
function divide($a, $b) 
{
    return $a / $b; // $b pourrait être 0 !
}') ?></code></pre>

                    <pre class="bg-success text-white p-3 rounded"><code><?= h('// ✅ Correction
function divide(int $a, int $b): int 
{
    if ($b === 0) {
        throw new InvalidArgumentException(\'Division par zéro\');
    }
    return $a / $b;
}') ?></code></pre>

                    <h5>Pourquoi c'est important ?</h5>
                    <ul>
                        <li>Détecte 90% des bugs avant qu'ils n'arrivent</li>
                        <li>Force à écrire du code plus sûr</li>
                        <li>Évite les erreurs en production</li>
                    </ul>

                    <hr>

                    <h3><i class="fas fa-broom"></i> 3. PHP_CodeSniffer - Le Nettoyeur de Code</h3>

                    <p><strong>Rôle :</strong> Uniformise le style du code dans tout le projet.</p>

                    <h5>Exemple :</h5>
                    <pre class="bg-danger text-white p-3 rounded"><code><?= h('// ❌ Avant (incohérent)
function test($a,$b){
return $a+$b;
}') ?></code></pre>

                    <pre class="bg-success text-white p-3 rounded"><code><?= h('// ✅ Après (uniforme)
function test(int $a, int $b): int
{
    return $a + $b;
}') ?></code></pre>

                    <h5>Pourquoi c'est important ?</h5>
                    <ul>
                        <li>Tout le monde écrit de la même façon</li>
                        <li>Le code est plus facile à lire</li>
                        <li>Collaboration simplifiée</li>
                    </ul>

                    <hr>

                    <h3><i class="fas fa-cog"></i> 4. Configuration</h3>

                    <h4>Fichiers de Configuration</h4>
                    <pre class="bg-dark text-light p-3 rounded"><code><?= h('votre-projet/
├── phpunit.xml.dist         → Config PHPUnit (tests)
├── phpstan.neon            → Config PHPStan (analyse)
├── phpstan-baseline.neon   → Baseline PHPStan
├── .php-cs-fixer.dist.php  → Config PHP-CS-Fixer (style)
└── composer.json            → Commandes disponibles') ?></code></pre>

                    <hr>

                    <h3><i class="fas fa-play"></i> 5. Comment Utiliser ?</h3>

                    <h4>Commandes Disponibles</h4>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Commande</th>
                                <th>Quand l'utiliser ?</th>
                                <th>Que fait-elle ?</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><code>composer test</code></td>
                                <td>Avant commit</td>
                                <td>Lance les tests</td>
                            </tr>
                            <tr>
                                <td><code>composer stan</code></td>
                                <td>Après nouveaux code</td>
                                <td>Analyse le code</td>
                            </tr>
                            <tr>
                                <td><code>composer cs-check</code></td>
                                <td>Avant commit</td>
                                <td>Vérifie le style</td>
                            </tr>
                            <tr>
                                <td><code>composer cs-fix</code></td>
                                <td>Après cs-check</td>
                                <td>Corrige le style</td>
                            </tr>
                            <tr>
                                <td><code>composer check</code></td>
                                <td>Avant push</td>
                                <td>Tout vérifier</td>
                            </tr>
                        </tbody>
                    </table>

                    <hr>

                    <h3><i class="fas fa-chart-bar"></i> Résumé</h3>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card border-primary">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-flask"></i> PHPUnit</h5>
                                    <p class="card-text">25 tests, 65 assertions</p>
                                    <p class="text-success"><strong>✅ 100% OK</strong></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-info">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-search"></i> PHPStan</h5>
                                    <p class="card-text">Niveau 8, 0 erreur</p>
                                    <p class="text-success"><strong>✅ Aucune erreur</strong></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-success">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-broom"></i> CodeSniffer</h5>
                                    <p class="card-text">Standard PSR-12</p>
                                    <p class="text-success"><strong>✅ Conforme</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

