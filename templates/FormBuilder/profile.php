<?php
/**
 * @var \App\View\AppView $this
 * @var array $profileData
 */
?>
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary btn-sm mb-3">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
            <h1 class="mb-2">
                <i class="fas fa-user-edit"></i> Formulaire de Profil
            </h1>
            <p class="text-muted">
                Exemple d'utilisation du FormBuilder AdminLTE pour créer un formulaire de profil utilisateur.
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Modifier le Profil</h3>
                </div>
                <div class="card-body">
                    <?= $this->Form->create(null, ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) ?>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <?= $this->AdminLteForm->textInput('firstname', [
                                'label' => ['text' => 'Prénom'],
                                'placeholder' => 'Votre prénom',
                                'value' => $profileData['firstname'] ?? '',
                                'templateVars' => ['icon' => 'fas fa-user']
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->AdminLteForm->textInput('lastname', [
                                'label' => ['text' => 'Nom'],
                                'placeholder' => 'Votre nom de famille',
                                'value' => $profileData['lastname'] ?? '',
                                'templateVars' => ['icon' => 'fas fa-user']
                            ]) ?>
                        </div>
                    </div>

                    <?= $this->AdminLteForm->emailInput('email', [
                        'label' => ['text' => 'Adresse email'],
                        'placeholder' => 'votre@email.com',
                        'value' => $profileData['email'] ?? ''
                    ]) ?>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $this->AdminLteForm->textInput('phone', [
                                'label' => ['text' => 'Téléphone'],
                                'placeholder' => '+33 1 23 45 67 89',
                                'value' => $profileData['phone'] ?? '',
                                'templateVars' => ['icon' => 'fas fa-phone']
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->AdminLteForm->selectInput('country', [
                                'label' => ['text' => 'Pays'],
                                'options' => [
                                    'FR' => 'France',
                                    'BE' => 'Belgique',
                                    'CH' => 'Suisse',
                                    'CA' => 'Canada',
                                    'US' => 'États-Unis',
                                    'DE' => 'Allemagne',
                                    'ES' => 'Espagne',
                                    'IT' => 'Italie'
                                ],
                                'templateVars' => ['icon' => 'fas fa-globe']
                            ]) ?>
                        </div>
                    </div>

                    <?= $this->AdminLteForm->textareaInput('bio', [
                        'label' => ['text' => 'Biographie'],
                        'placeholder' => 'Parlez-nous de vous...',
                        'rows' => 4,
                        'value' => $profileData['bio'] ?? '',
                        'templateVars' => ['icon' => 'fas fa-user-circle']
                    ]) ?>

                    <?= $this->AdminLteForm->fileInput('avatar', [
                        'label' => ['text' => 'Photo de profil'],
                        'templateVars' => ['icon' => 'fas fa-camera']
                    ]) ?>

                    <div class="form-group">
                        <label class="form-label">Préférences</label>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $this->AdminLteForm->checkboxInput('notifications', [
                                    'label' => ['text' => 'Notifications par email'],
                                    'value' => '1',
                                    'checked' => $profileData['notifications'] ?? false
                                ]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $this->AdminLteForm->checkboxInput('newsletter', [
                                    'label' => ['text' => 'Newsletter'],
                                    'value' => '1',
                                    'checked' => $profileData['newsletter'] ?? false
                                ]) ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Thème</label>
                        <div class="row">
                            <div class="col-md-4">
                                <?= $this->AdminLteForm->radioInput('theme', [
                                    'label' => ['text' => 'Clair'],
                                    'value' => 'light',
                                    'name' => 'theme'
                                ]) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $this->AdminLteForm->radioInput('theme', [
                                    'label' => ['text' => 'Sombre'],
                                    'value' => 'dark',
                                    'name' => 'theme'
                                ]) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $this->AdminLteForm->radioInput('theme', [
                                    'label' => ['text' => 'Auto'],
                                    'value' => 'auto',
                                    'name' => 'theme'
                                ]) ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-right">
                        <?= $this->AdminLteForm->resetButton('Annuler', ['class' => 'btn btn-secondary mr-2']) ?>
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
                    <h6>Champ Fichier :</h6>
                    <pre><code class="php"><?= htmlspecialchars('<?= $this->AdminLteForm->fileInput(\'avatar\', [
    \'label\' => [\'text\' => \'Photo de profil\']
]) ?>') ?></code></pre>

                    <h6>Boutons Radio :</h6>
                    <pre><code class="php"><?= htmlspecialchars('<?= $this->AdminLteForm->radioInput(\'theme\', [
    \'label\' => [\'text\' => \'Clair\'],
    \'value\' => \'light\',
    \'name\' => \'theme\'
]) ?>') ?></code></pre>

                    <h6>Zone de Texte :</h6>
                    <pre><code class="php"><?= htmlspecialchars('<?= $this->AdminLteForm->textareaInput(\'bio\', [
    \'label\' => [\'text\' => \'Biographie\'],
    \'rows\' => 4
]) ?>') ?></code></pre>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">Fonctionnalités</h3>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success"></i> Upload d'avatar</li>
                        <li><i class="fas fa-check text-success"></i> Boutons radio pour thème</li>
                        <li><i class="fas fa-check text-success"></i> Cases à cocher multiples</li>
                        <li><i class="fas fa-check text-success"></i> Zone de texte biographie</li>
                        <li><i class="fas fa-check text-success"></i> Sélecteur de pays</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
