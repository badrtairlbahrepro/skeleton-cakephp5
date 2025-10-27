<?php
/**
 * Page d'accueil
 *
 * @var \App\View\AppView $this
 */
$this->assign('title', 'Bienvenue');
?>

<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>Hexagonal</h3>
                <p>Architecture</p>
            </div>
            <div class="icon">
                <i class="fas fa-cube"></i>
            </div>
            <?= $this->Html->link('Plus d\'infos <i class="fas fa-arrow-circle-right"></i>', ['controller' => 'Pages', 'action' => 'display', 'about'], ['class' => 'small-box-footer', 'escape' => false]) ?>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>DDD</h3>
                <p>Domain-Driven Design</p>
            </div>
            <div class="icon">
                <i class="fas fa-layer-group"></i>
            </div>
            <?= $this->Html->link('Plus d\'infos <i class="fas fa-arrow-circle-right"></i>', ['controller' => 'Pages', 'action' => 'display', 'ddd'], ['class' => 'small-box-footer', 'escape' => false]) ?>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>Injection</h3>
                <p>Dépendances</p>
            </div>
            <div class="icon">
                <i class="fas fa-plug"></i>
            </div>
            <?= $this->Html->link('Plus d\'infos <i class="fas fa-arrow-circle-right"></i>', ['controller' => 'Pages', 'action' => 'display', 'dependency-injection'], ['class' => 'small-box-footer', 'escape' => false]) ?>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>AdminLTE FormBuilder</h3>
                <p>Génération de formulaires</p>
            </div>
            <div class="icon">
                <i class="fas fa-paint-brush"></i>
            </div>
            <?= $this->Html->link('Plus d\'infos <i class="fas fa-arrow-circle-right"></i>', '/form-builder', ['class' => 'small-box-footer', 'escape' => false]) ?>
        </div>
    </div>
</div>

<!-- Second Row: New Links -->
<div class="row mt-2">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-purple">
            <div class="inner">
                <h3><i class="fas fa-tasks"></i> Outils</h3>
                <p>Qualité du Code</p>
            </div>
            <div class="icon">
                <i class="fas fa-vial"></i>
            </div>
            <?= $this->Html->link('Voir <i class="fas fa-arrow-circle-right"></i>', '/quality-tools', ['class' => 'small-box-footer', 'escape' => false]) ?>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="inner">
                <h3><i class="fas fa-flask"></i> Tests</h3>
                <p>Guide Complet</p>
            </div>
            <div class="icon">
                <i class="fas fa-book"></i>
            </div>
            <?= $this->Html->link('Guide <i class="fas fa-arrow-circle-right"></i>', '/pages/test-guide', ['class' => 'small-box-footer', 'escape' => false]) ?>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><i class="fas fa-tools"></i> Qualité</h3>
                <p>Configuration</p>
            </div>
            <div class="icon">
                <i class="fas fa-cog"></i>
            </div>
            <?= $this->Html->link('Config <i class="fas fa-arrow-circle-right"></i>', '/pages/quality-guide', ['class' => 'small-box-footer', 'escape' => false]) ?>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3><i class="fas fa-file-alt"></i> Logs</h3>
                <p>Visualiseur</p>
            </div>
            <div class="icon">
                <i class="fas fa-search"></i>
            </div>
            <?= $this->Html->link('Logs <i class="fas fa-arrow-circle-right"></i>', '/logs', ['class' => 'small-box-footer', 'escape' => false]) ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle mr-1"></i>
                    Informations du Projet
                </h3>
            </div>
            <div class="card-body">
                <h4>Bienvenue sur le Squelette CakePHP Hexagonal Architecture</h4>
                <p>Ce projet démontre:</p>
                <ul>
                    <li><strong>Architecture Hexagonale (Ports & Adapters)</strong> - Séparation propre des préoccupations</li>
                    <li><strong>Domain-Driven Design (DDD)</strong> - Modèles de domaine riches avec logique métier</li>
                    <li><strong>Injection de Dépendances Automatique</strong> - Utilisant le conteneur DI de CakePHP 5</li>
                    <li><strong>Intégration AdminLTE</strong> - Interface d'administration belle et réactive</li>
                    <li><strong>Principes SOLID</strong> - Code maintenable et testable</li>
                </ul>

                <h5 class="mt-4">Couches d'Architecture:</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="info-box bg-gradient-info">
                            <span class="info-box-icon"><i class="fas fa-gem"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Couche Métier</span>
                                <span class="info-box-number">Entités & Logique Métier</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box bg-gradient-success">
                            <span class="info-box-icon"><i class="fas fa-cogs"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Couche Application</span>
                                <span class="info-box-number">Cas d'Usage & Services</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box bg-gradient-warning">
                            <span class="info-box-icon"><i class="fas fa-database"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Couche Infrastructure</span>
                                <span class="info-box-number">Persistance & Externe</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-success mt-3">
                    <h5><i class="icon fas fa-check"></i> Démarrage Rapide</h5>
                    <ol>
                        <li>Exécutez <code>composer install</code> pour installer les dépendances</li>
                        <li>Copiez <code>config/app_local.example.php</code> en <code>config/app_local.php</code></li>
                        <li>Configurez votre base de données dans <code>config/app_local.php</code></li>
                        <li>Exécutez les migrations: <code>bin/cake migrations migrate</code></li>
                        <li>Démarrez le serveur: <code>bin/cake server</code></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
