<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="mb-2">
                <i class="fas fa-tools"></i> FormBuilder AdminLTE
            </h1>
            <p class="text-muted">
                Système de génération rapide de formulaires avec le style AdminLTE.
                Utilisez le <code>AdminLteFormHelper</code> pour créer des formulaires
                professionnels en quelques lignes de code.
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-envelope"></i> Formulaire de Contact
                    </h3>
                </div>
                <div class="card-body">
                    <p>Exemple de formulaire de contact avec tous les champs de base.</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success"></i> Champ texte avec icône</li>
                        <li><i class="fas fa-check text-success"></i> Champ email avec validation</li>
                        <li><i class="fas fa-check text-success"></i> Zone de texte multi-lignes</li>
                        <li><i class="fas fa-check text-success"></i> Sélecteur de catégorie</li>
                    </ul>
                    <?= $this->Html->link(
                        'Voir l\'exemple',
                        ['action' => 'contact'],
                        ['class' => 'btn btn-primary']
                    ) ?>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-user-plus"></i> Formulaire d'Inscription
                    </h3>
                </div>
                <div class="card-body">
                    <p>Exemple de formulaire d'inscription avec validation.</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success"></i> Champs nom/prénom</li>
                        <li><i class="fas fa-check text-success"></i> Mot de passe avec affichage</li>
                        <li><i class="fas fa-check text-success"></i> Confirmation mot de passe</li>
                        <li><i class="fas fa-check text-success"></i> Case à cocher conditions</li>
                    </ul>
                    <?= $this->Html->link(
                        'Voir l\'exemple',
                        ['action' => 'register'],
                        ['class' => 'btn btn-primary']
                    ) ?>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-user-edit"></i> Formulaire de Profil
                    </h3>
                </div>
                <div class="card-body">
                    <p>Exemple de formulaire de profil utilisateur complet.</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success"></i> Informations personnelles</li>
                        <li><i class="fas fa-check text-success"></i> Upload d'avatar</li>
                        <li><i class="fas fa-check text-success"></i> Préférences notifications</li>
                        <li><i class="fas fa-check text-success"></i> Boutons d'action</li>
                    </ul>
                    <?= $this->Html->link(
                        'Voir l\'exemple',
                        ['action' => 'profile'],
                        ['class' => 'btn btn-primary']
                    ) ?>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-search"></i> Formulaire de Recherche
                    </h3>
                </div>
                <div class="card-body">
                    <p>Exemple de formulaire de recherche avancée.</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success"></i> Champ de recherche</li>
                        <li><i class="fas fa-check text-success"></i> Filtres par date</li>
                        <li><i class="fas fa-check text-success"></i> Sélecteurs multiples</li>
                        <li><i class="fas fa-check text-success"></i> Upload de fichier</li>
                    </ul>
                    <?= $this->Html->link(
                        'Voir l\'exemple',
                        ['action' => 'search'],
                        ['class' => 'btn btn-primary']
                    ) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-list-check"></i> Sélecteurs Multiples
                    </h3>
                </div>
                <div class="card-body">
                    <p>Exemple de formulaire avec sélecteurs multiples.</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success"></i> Sélection multiple</li>
                        <li><i class="fas fa-check text-success"></i> Icônes personnalisées</li>
                        <li><i class="fas fa-check text-success"></i> Style AdminLTE</li>
                        <li><i class="fas fa-check text-success"></i> Support Ctrl/Cmd+clic</li>
                    </ul>
                    <?= $this->Html->link(
                        'Voir l\'exemple',
                        ['action' => 'multiple'],
                        ['class' => 'btn btn-primary']
                    ) ?>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-toggle-on"></i> Switches (Toggle)
                    </h3>
                </div>
                <div class="card-body">
                    <p>Exemple de formulaire avec switches personnalisés.</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success"></i> Toggle animé</li>
                        <li><i class="fas fa-check text-success"></i> Style AdminLTE</li>
                        <li><i class="fas fa-check text-success"></i> État activé/désactivé</li>
                        <li><i class="fas fa-check text-success"></i> Accessibilité</li>
                    </ul>
                    <?= $this->Html->link(
                        'Voir l\'exemple',
                        ['action' => 'switches'],
                        ['class' => 'btn btn-primary']
                    ) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-code"></i> Comment utiliser le FormBuilder
                    </h3>
                </div>
                <div class="card-body">
                    <h5>1. Charger le Helper dans votre contrôleur :</h5>
                    <pre><code class="php"><?= htmlspecialchars('// Dans src/Controller/AppController.php
public function beforeRender(\Cake\Event\EventInterface $event): void
{
    parent::beforeRender($event);
    // Charger le helper AdminLteForm pour tous les contrôleurs
    $this->viewBuilder()->addHelper(\'AdminLteForm\');
}') ?></code></pre>

                    <h5>2. Utiliser dans vos templates :</h5>
                    <pre><code class="php"><?= htmlspecialchars('// Dans votre template .php
<?= $this->Form->create(null, [\'class\' => \'form-horizontal\']) ?>
<div class="card-body">
    <!-- Champ texte avec icône -->
    <?= $this->AdminLteForm->textInput(\'name\', [
        \'label\' => [\'text\' => \'Nom complet\'],
        \'placeholder\' => \'Votre nom\',
        \'templateVars\' => [\'icon\' => \'fas fa-user\']
    ]) ?>

    <!-- Champ email -->
    <?= $this->AdminLteForm->emailInput(\'email\', [
        \'label\' => [\'text\' => \'Adresse email\'],
        \'placeholder\' => \'votre@email.com\'
    ]) ?>

    <!-- Mot de passe avec bouton afficher/masquer -->
    <?= $this->AdminLteForm->passwordInput(\'password\', [
        \'label\' => [\'text\' => \'Mot de passe\'],
        \'placeholder\' => \'Votre mot de passe\'
    ]) ?>

    <!-- Zone de texte -->
    <?= $this->AdminLteForm->textareaInput(\'message\', [
        \'label\' => [\'text\' => \'Message\'],
        \'rows\' => 4,
        \'placeholder\' => \'Votre message...\'
    ]) ?>

    <!-- Upload de fichier -->
    <?= $this->AdminLteForm->fileInput(\'avatar\', [
        \'label\' => [\'text\' => \'Photo de profil\']
    ]) ?>

    <!-- Case à cocher -->
    <?= $this->AdminLteForm->checkboxInput(\'newsletter\', [
        \'label\' => [\'text\' => \'Je souhaite recevoir la newsletter\']
    ]) ?>
</div>
<div class="card-footer text-right">
    <?= $this->AdminLteForm->resetButton(\'Annuler\', [\'class\' => \'btn btn-secondary mr-2\']) ?>
    <?= $this->AdminLteForm->submitButton(\'Envoyer\', [\'class\' => \'btn btn-primary\']) ?>
</div>
<?= $this->Form->end() ?>') ?></code></pre>

                    <h5>3. Méthodes disponibles :</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li><code>textInput()</code> - Champ texte avec icône</li>
                                <li><code>emailInput()</code> - Champ email</li>
                                <li><code>passwordInput()</code> - Mot de passe avec toggle</li>
                                <li><code>textareaInput()</code> - Zone de texte multi-lignes</li>
                                <li><code>fileInput()</code> - Upload de fichier AdminLTE</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li><code>selectInput()</code> - Liste déroulante avec icône</li>
                                <li><code>checkboxInput()</code> - Case à cocher</li>
                                <li><code>radioInput()</code> - Bouton radio</li>
                                <li><code>submitButton()</code> - Bouton d'envoi</li>
                                <li><code>resetButton()</code> - Bouton de réinitialisation</li>
                            </ul>
                        </div>
                    </div>

                    <div class="alert alert-info mt-3">
                        <h6><i class="fas fa-info-circle"></i> Documentation complète :</h6>
                        <p class="mb-2">Consultez la documentation détaillée pour plus d'exemples et d'options.</p>
                        <a href="/FORMBUILDER_QUICKSTART.md" class="btn btn-outline-info btn-sm" target="_blank">
                            <i class="fas fa-book"></i> Guide Rapide
                        </a>
                        <a href="/FORMBUILDER.md" class="btn btn-outline-info btn-sm ml-2" target="_blank">
                            <i class="fas fa-file-alt"></i> Documentation Complète
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
