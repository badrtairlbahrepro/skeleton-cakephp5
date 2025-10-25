<?php
/**
 * @var \App\View\AppView $this
 * @var array $contactData
 */
?>
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary btn-sm mb-3">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
            <h1 class="mb-2">
                <i class="fas fa-envelope"></i> Formulaire de Contact
            </h1>
            <p class="text-muted">
                Exemple d'utilisation du FormBuilder AdminLTE pour créer un formulaire de contact.
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Formulaire de Contact</h3>
                </div>
                <div class="card-body">
                    <?= $this->Form->create(null, ['class' => 'form-horizontal']) ?>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <?= $this->AdminLteForm->textInput('name', [
                                'label' => ['text' => 'Nom complet'],
                                'placeholder' => 'Votre nom complet',
                                'value' => $contactData['name'] ?? '',
                                'templateVars' => ['icon' => 'fas fa-user']
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->AdminLteForm->emailInput('email', [
                                'label' => ['text' => 'Adresse email'],
                                'placeholder' => 'votre@email.com',
                                'value' => $contactData['email'] ?? ''
                            ]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $this->AdminLteForm->selectInput('subject', [
                                'label' => ['text' => 'Sujet'],
                                'options' => [
                                    'question' => 'Question générale',
                                    'support' => 'Support technique',
                                    'billing' => 'Facturation',
                                    'other' => 'Autre'
                                ],
                                'value' => $contactData['subject'] ?? '',
                                'templateVars' => ['icon' => 'fas fa-tag']
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

                    <?= $this->AdminLteForm->textareaInput('message', [
                        'label' => ['text' => 'Message'],
                        'placeholder' => 'Décrivez votre demande en détail...',
                        'rows' => 5,
                        'value' => $contactData['message'] ?? '',
                        'templateVars' => ['icon' => 'fas fa-comment']
                    ]) ?>

                    <div class="form-group">
                        <?= $this->AdminLteForm->checkboxInput('newsletter', [
                            'label' => ['text' => 'Je souhaite recevoir la newsletter'],
                            'value' => '1'
                        ]) ?>
                    </div>

                    <div class="form-group text-right">
                        <?= $this->AdminLteForm->resetButton('Réinitialiser', ['class' => 'btn btn-secondary mr-2']) ?>
                        <?= $this->AdminLteForm->submitButton('Envoyer le message', ['class' => 'btn btn-primary']) ?>
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
                    <h6>Champ Email :</h6>
                    <pre><code class="php"><?= htmlspecialchars('<?= $this->AdminLteForm->emailInput(\'email\', [
    \'label\' => [\'text\' => \'Adresse email\'],
    \'placeholder\' => \'votre@email.com\'
]) ?>') ?></code></pre>

                    <h6>Zone de Texte :</h6>
                    <pre><code class="php"><?= htmlspecialchars('<?= $this->AdminLteForm->textareaInput(\'message\', [
    \'label\' => [\'text\' => \'Message\'],
    \'rows\' => 5,
    \'templateVars\' => [\'icon\' => \'fas fa-comment\']
]) ?>') ?></code></pre>

                    <h6>Sélecteur :</h6>
                    <pre><code class="php"><?= htmlspecialchars('<?= $this->AdminLteForm->selectInput(\'subject\', [
    \'options\' => [
        \'question\' => \'Question générale\',
        \'support\' => \'Support technique\'
    ]
]) ?>') ?></code></pre>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">Fonctionnalités</h3>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success"></i> Icônes automatiques</li>
                        <li><i class="fas fa-check text-success"></i> Validation HTML5</li>
                        <li><i class="fas fa-check text-success"></i> Style AdminLTE</li>
                        <li><i class="fas fa-check text-success"></i> Input-group intégré</li>
                        <li><i class="fas fa-check text-success"></i> Responsive design</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
