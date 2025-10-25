<?php
/**
 * @var \App\View\AppView $this
 * @var array $registerData
 */
?>
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary btn-sm mb-3">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
            <h1 class="mb-2">
                <i class="fas fa-user-plus"></i> Formulaire d'Inscription
            </h1>
            <p class="text-muted">
                Exemple d'utilisation du FormBuilder AdminLTE pour créer un formulaire d'inscription.
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Créer un compte</h3>
                </div>
                <div class="card-body">
                    <?= $this->Form->create(null, ['class' => 'form-horizontal']) ?>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <?= $this->AdminLteForm->textInput('firstname', [
                                'label' => ['text' => 'Prénom'],
                                'placeholder' => 'Votre prénom',
                                'value' => $registerData['firstname'] ?? '',
                                'templateVars' => ['icon' => 'fas fa-user']
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->AdminLteForm->textInput('lastname', [
                                'label' => ['text' => 'Nom'],
                                'placeholder' => 'Votre nom de famille',
                                'value' => $registerData['lastname'] ?? '',
                                'templateVars' => ['icon' => 'fas fa-user']
                            ]) ?>
                        </div>
                    </div>

                    <?= $this->AdminLteForm->emailInput('email', [
                        'label' => ['text' => 'Adresse email'],
                        'placeholder' => 'votre@email.com',
                        'value' => $registerData['email'] ?? ''
                    ]) ?>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $this->AdminLteForm->passwordInput('password', [
                                'label' => ['text' => 'Mot de passe'],
                                'placeholder' => 'Minimum 8 caractères'
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->AdminLteForm->passwordInput('confirm_password', [
                                'label' => ['text' => 'Confirmer le mot de passe'],
                                'placeholder' => 'Répétez le mot de passe'
                            ]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $this->AdminLteForm->selectInput('country', [
                                'label' => ['text' => 'Pays'],
                                'options' => [
                                    'FR' => 'France',
                                    'BE' => 'Belgique',
                                    'CH' => 'Suisse',
                                    'CA' => 'Canada',
                                    'US' => 'États-Unis'
                                ],
                                'templateVars' => ['icon' => 'fas fa-globe']
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->AdminLteForm->textInput('phone', [
                                'label' => ['text' => 'Téléphone (optionnel)'],
                                'placeholder' => '+33 1 23 45 67 89',
                                'templateVars' => ['icon' => 'fas fa-phone']
                            ]) ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Préférences de communication</label>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $this->AdminLteForm->checkboxInput('newsletter', [
                                    'label' => ['text' => 'Newsletter'],
                                    'value' => '1'
                                ]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $this->AdminLteForm->checkboxInput('notifications', [
                                    'label' => ['text' => 'Notifications email'],
                                    'value' => '1'
                                ]) ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <?= $this->AdminLteForm->checkboxInput('terms', [
                            'label' => ['text' => 'J\'accepte les conditions d\'utilisation'],
                            'value' => '1',
                            'required' => true
                        ]) ?>
                    </div>

                    <div class="form-group text-right">
                        <?= $this->AdminLteForm->resetButton('Réinitialiser', ['class' => 'btn btn-secondary mr-2']) ?>
                        <?= $this->AdminLteForm->submitButton('Créer mon compte', ['class' => 'btn btn-success']) ?>
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
                    <h6>Champ Prénom :</h6>
                    <pre><code class="php"><?= htmlspecialchars('<?= $this->AdminLteForm->textInput(\'firstname\', [
    \'label\' => [\'text\' => \'Prénom\'],
    \'placeholder\' => \'Votre prénom\',
    \'templateVars\' => [\'icon\' => \'fas fa-user\']
]) ?>') ?></code></pre>

                    <h6>Champ Email :</h6>
                    <pre><code class="php"><?= htmlspecialchars('<?= $this->AdminLteForm->emailInput(\'email\', [
    \'label\' => [\'text\' => \'Adresse email\'],
    \'placeholder\' => \'votre@email.com\'
]) ?>') ?></code></pre>

                    <h6>Select Pays :</h6>
                    <pre><code class="php"><?= htmlspecialchars('<?= $this->AdminLteForm->selectInput(\'country\', [
    \'label\' => [\'text\' => \'Pays\'],
    \'options\' => [
        \'FR\' => \'France\',
        \'BE\' => \'Belgique\',
        \'CH\' => \'Suisse\'
    ]
]) ?>') ?></code></pre>

                    <h6>Case à Cocher :</h6>
                    <pre><code class="php"><?= htmlspecialchars('<?= $this->AdminLteForm->checkboxInput(\'terms\', [
    \'label\' => [\'text\' => \'J\\\'accepte les conditions\'],
    \'required\' => true
]) ?>') ?></code></pre>

                    <h6>Boutons :</h6>
                    <pre><code class="php"><?= htmlspecialchars('<?= $this->AdminLteForm->submitButton(\'Créer mon compte\', [
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
                        <li><i class="fas fa-check text-success"></i> Mot de passe avec affichage</li>
                        <li><i class="fas fa-check text-success"></i> Validation côté client</li>
                        <li><i class="fas fa-check text-success"></i> Cases à cocher multiples</li>
                        <li><i class="fas fa-check text-success"></i> Boutons personnalisés</li>
                        <li><i class="fas fa-check text-success"></i> Layout responsive</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
