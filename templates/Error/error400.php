<?php
/**
 * Error 400 Template - Bad Request
 */
$this->layout = 'error';
?>

<div class="error-container error-400">
    <div class="error-card">
        <div class="error-icon">❌</div>
        <div class="error-code">400</div>
        <h1 class="error-title">Requête Invalide</h1>
        <p class="error-message">
            <?php if (!empty($error)): ?>
                <?= h($error->getMessage()) ?>
            <?php else: ?>
                Les paramètres de votre requête sont incorrects ou mal formés.
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
