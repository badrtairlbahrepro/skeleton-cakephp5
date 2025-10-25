<?php
/**
 * @var \App\View\AppView $this
 * @var array $switchData
 */
?>
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary btn-sm mb-3">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
            <h1 class="mb-2">
                <i class="fas fa-toggle-on"></i> Switches (Toggle)
            </h1>
            <p class="text-muted">
                Exemple d'utilisation du FormBuilder AdminLTE pour créer des switches personnalisés.
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Préférences Utilisateur</h3>
                </div>
                <div class="card-body">
                    <?= $this->Form->create(null, ['class' => 'form-horizontal']) ?>
                    
                    <div class="form-group">
                        <label class="form-label">Notifications</label>
                        <?= $this->AdminLteForm->switchInput('notifications', [
                            'label' => ['text' => 'Recevoir les notifications par email'],
                            'value' => '1',
                            'checked' => $switchData['notifications'] ?? false
                        ]) ?>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Thème</label>
                        <?= $this->AdminLteForm->switchInput('dark_mode', [
                            'label' => ['text' => 'Mode sombre activé'],
                            'value' => '1',
                            'checked' => $switchData['dark_mode'] ?? false
                        ]) ?>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Sauvegarde</label>
                        <?= $this->AdminLteForm->switchInput('auto_save', [
                            'label' => ['text' => 'Sauvegarde automatique'],
                            'value' => '1',
                            'checked' => $switchData['auto_save'] ?? false
                        ]) ?>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Profil</label>
                        <?= $this->AdminLteForm->switchInput('public_profile', [
                            'label' => ['text' => 'Profil public visible'],
                            'value' => '1',
                            'checked' => $switchData['public_profile'] ?? false
                        ]) ?>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Sécurité</label>
                        <?= $this->AdminLteForm->switchInput('two_factor', [
                            'label' => ['text' => 'Authentification à deux facteurs'],
                            'value' => '1',
                            'checked' => false
                        ]) ?>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Marketing</label>
                        <?= $this->AdminLteForm->switchInput('marketing_emails', [
                            'label' => ['text' => 'Recevoir les emails marketing'],
                            'value' => '1',
                            'checked' => false
                        ]) ?>
                    </div>

                    <div class="form-group text-right">
                        <?= $this->AdminLteForm->resetButton('Réinitialiser', ['class' => 'btn btn-secondary mr-2']) ?>
                        <?= $this->AdminLteForm->submitButton('Sauvegarder', ['class' => 'btn btn-success']) ?>
                    </div>

                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Code Source</h3>
                </div>
                <div class="card-body">
                    <h6>Switch Simple :</h6>
                    <pre><code class="php"><?= htmlspecialchars('<?= $this->AdminLteForm->switchInput(\'notifications\', [
    \'label\' => [\'text\' => \'Recevoir les notifications\'],
    \'value\' => \'1\',
    \'checked\' => true
]) ?>') ?></code></pre>

                    <h6>Switch avec État :</h6>
                    <pre><code class="php"><?= htmlspecialchars('<?= $this->AdminLteForm->switchInput(\'dark_mode\', [
    \'label\' => [\'text\' => \'Mode sombre activé\'],
    \'checked\' => $user->dark_mode
]) ?>') ?></code></pre>

                    <h6>Switch Désactivé :</h6>
                    <pre><code class="php"><?= htmlspecialchars('<?= $this->AdminLteForm->switchInput(\'two_factor\', [
    \'label\' => [\'text\' => \'Authentification 2FA\'],
    \'disabled\' => true
]) ?>') ?></code></pre>

                    <h6>Boutons :</h6>
                    <pre><code class="php"><?= htmlspecialchars('<?= $this->AdminLteForm->submitButton(\'Sauvegarder\', [
    \'class\' => \'btn btn-success\'
]) ?>') ?></code></pre>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">Fonctionnalités</h3>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success"></i> Toggle animé</li>
                        <li><i class="fas fa-check text-success"></i> Style AdminLTE</li>
                        <li><i class="fas fa-check text-success"></i> État activé/désactivé</li>
                        <li><i class="fas fa-check text-success"></i> Support disabled</li>
                        <li><i class="fas fa-check text-success"></i> Accessibilité</li>
                        <li><i class="fas fa-check text-success"></i> Responsive design</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
