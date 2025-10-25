<?php
/**
 * Error 401 Template - Unauthorized
 */
$this->layout = 'error';
?>

<div class="error-container error-401">
    <div class="error-card">
        <div class="error-icon">🔑</div>
        <div class="error-code">401</div>
        <h1 class="error-title">Non Authentifié</h1>
        <p class="error-message">
            <?php if (!empty($error)): ?>
                <?= h($error->getMessage()) ?>
            <?php else: ?>
                Veuillez vous connecter pour accéder à cette ressource.
            <?php endif; ?>
        </p>
        <div class="error-buttons">
            <a href="/login" class="btn-primary-modern">
                <i class="fas fa-sign-in-alt"></i> Se Connecter
            </a>
            <a href="/" class="btn-secondary-modern">
                <i class="fas fa-home"></i> Accueil
            </a>
        </div>
    </div>
</div>
