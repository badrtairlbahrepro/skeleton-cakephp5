<?php
/**
 * Error 500 Template - Internal Server Error
 */
$this->layout = 'error';
?>

<div class="error-container error-500">
    <div class="error-card">
        <div class="error-icon">💥</div>
        <div class="error-code">500</div>
        <h1 class="error-title">Erreur Serveur</h1>
        <p class="error-message">
            <?php if (!empty($error)): ?>
                <?= h($error->getMessage()) ?>
            <?php else: ?>
                Une erreur inattendue s'est produite sur le serveur.
            <?php endif; ?>
        </p>
        <div class="error-buttons">
            <a href="/" class="btn-primary-modern">
                <i class="fas fa-home"></i> Retour à l'Accueil
            </a>
            <a href="javascript:history.back()" class="btn-secondary-modern">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
    </div>
</div>
