<?php
?>
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="mb-2">
                <i class="fas fa-puzzle-piece"></i> Component Library
            </h1>
            <p class="text-muted">
                Galerie complète de tous les composants AdminLTE disponibles. 
                Cliquez sur un groupe pour voir les variantes et copier le code.
            </p>
        </div>
    </div>

    <div class="row">
        <?php foreach ($components as $key => $component): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 component-card">
                    <div class="card-body text-center">
                        <div style="font-size: 2.5rem; margin-bottom: 15px; color: #007bff;">
                            <i class="fas <?= $component['icon'] ?>"></i>
                        </div>
                        <h5 class="card-title" style="margin-bottom: 8px;">
                            <?= $component['name'] ?>
                        </h5>
                        <p class="card-text text-muted small" style="margin-bottom: 15px;">
                            <?= $component['description'] ?? '' ?>
                        </p>
                        <p class="text-secondary" style="font-size: 0.9rem; margin-bottom: 15px;">
                            <strong><?= count($component['variants'] ?? []) ?> variantes</strong>
                        </p>
                        <?= $this->Html->link(
                            '<i class="fas fa-arrow-right"></i> Voir les exemples',
                            ['action' => 'view', $key],
                            ['class' => 'btn btn-primary btn-sm', 'escape' => false]
                        ) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
.component-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid #e3e6f0;
}

.component-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}
</style>
