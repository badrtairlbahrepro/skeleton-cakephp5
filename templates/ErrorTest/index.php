<?php
/**
 * Error Test Controller - Index Page
 */
$this->assign('title', 'Test des Pages d\'Erreur');
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-bug mr-2"></i>
                    Test des Pages d'Erreur
                </h3>
            </div>
            <div class="card-body">
                <p>Cliquez sur les boutons ci-dessous pour tester chaque page d'erreur:</p>

                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="card card-warning">
                            <div class="card-header">
                                <h5 class="card-title">404 - Page Not Found</h5>
                            </div>
                            <div class="card-body">
                                <p>Teste le template <code>error404.php</code></p>
                                <?= $this->Html->link(
                                    '<i class="fas fa-exclamation-triangle"></i> Tester 404',
                                    ['action' => 'error404'],
                                    ['class' => 'btn btn-warning btn-block', 'escape' => false]
                                ) ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h5 class="card-title">403 - Forbidden</h5>
                            </div>
                            <div class="card-body">
                                <p>Teste le template <code>error403.php</code></p>
                                <?= $this->Html->link(
                                    '<i class="fas fa-lock"></i> Tester 403',
                                    ['action' => 'error403'],
                                    ['class' => 'btn btn-danger btn-block', 'escape' => false]
                                ) ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-info">
                            <div class="card-header">
                                <h5 class="card-title">400 - Bad Request</h5>
                            </div>
                            <div class="card-body">
                                <p>Teste le template <code>error400.php</code></p>
                                <?= $this->Html->link(
                                    '<i class="fas fa-times-circle"></i> Tester 400',
                                    ['action' => 'error400'],
                                    ['class' => 'btn btn-info btn-block', 'escape' => false]
                                ) ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h5 class="card-title">401 - Unauthorized</h5>
                            </div>
                            <div class="card-body">
                                <p>Teste le template <code>error401.php</code></p>
                                <?= $this->Html->link(
                                    '<i class="fas fa-user-slash"></i> Tester 401',
                                    ['action' => 'error401'],
                                    ['class' => 'btn btn-secondary btn-block', 'escape' => false]
                                ) ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h5 class="card-title">500 - Server Error</h5>
                            </div>
                            <div class="card-body">
                                <p>Teste le template <code>error500.php</code></p>
                                <?= $this->Html->link(
                                    '<i class="fas fa-fire"></i> Tester 500',
                                    ['action' => 'error500'],
                                    ['class' => 'btn btn-danger btn-block', 'escape' => false]
                                ) ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-dark">
                            <div class="card-header">
                                <h5 class="card-title">Generic Error</h5>
                            </div>
                            <div class="card-body">
                                <p>Teste le template <code>error.php</code></p>
                                <?= $this->Html->link(
                                    '<i class="fas fa-question-circle"></i> Tester Generic',
                                    ['action' => 'generic'],
                                    ['class' => 'btn btn-dark btn-block', 'escape' => false]
                                ) ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            <h5><i class="fas fa-info-circle"></i> Informations</h5>
                            <ul>
                                <li><strong>404:</strong> Page non trouvée</li>
                                <li><strong>403:</strong> Accès refusé (permissions insuffisantes)</li>
                                <li><strong>400:</strong> Requête invalide</li>
                                <li><strong>401:</strong> Non authentifié</li>
                                <li><strong>500:</strong> Erreur interne du serveur</li>
                                <li><strong>Generic:</strong> Erreur non spécifiée (template par défaut)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
