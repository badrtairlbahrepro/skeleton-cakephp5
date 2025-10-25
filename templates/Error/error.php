<?php
/**
 * Generic Error Template - Fallback for unknown errors
 */
$this->layout = 'error';
?>

<div class="error-container error-generic">
    <div class="error-card">
        <div class="error-icon">❓</div>
        <div class="error-code"><?= !empty($error) ? $error->getCode() : 'Error' ?></div>
        <h1 class="error-title">Erreur</h1>
        <p class="error-message">
            <?php if (!empty($error)): ?>
                <?= h($error->getMessage()) ?>
            <?php else: ?>
                Une erreur est survenue. Veuillez réessayer plus tard.
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
