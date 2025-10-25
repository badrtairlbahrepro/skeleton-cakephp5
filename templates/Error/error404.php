<?php
/**
 * Error 404 Template - Page Not Found
 */
$this->layout = 'error';
?>

<div class="error-container error-404">
    <div class="error-card">
        <div class="error-icon">🔍</div>
        <div class="error-code">404</div>
        <h1 class="error-title">Page Non Trouvée</h1>
        <p class="error-message">
            <?php if (!empty($error)): ?>
                <?= h($error->getMessage()) ?>
            <?php else: ?>
                Désolé, la ressource que vous recherchez n'existe pas ou a été supprimée.
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
