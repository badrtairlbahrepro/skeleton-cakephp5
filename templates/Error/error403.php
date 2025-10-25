<?php
/**
 * Error 403 Template - Access Forbidden
 */
$this->layout = 'error';
?>

<div class="error-container error-403">
    <div class="error-card">
        <div class="error-icon">🔐</div>
        <div class="error-code">403</div>
        <h1 class="error-title">Accès Refusé</h1>
        <p class="error-message">
            <?php if (!empty($error)): ?>
                <?= h($error->getMessage()) ?>
            <?php else: ?>
                Vous n'avez pas les permissions nécessaires pour accéder à cette ressource.
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
