<?php
/**
 * Template d'ajout d'utilisateur
 *
 * @var \App\View\AppView $this
 */
$this->assign('title', 'Ajouter un utilisateur');
?>

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user-plus mr-2"></i>
                    Créer un nouvel utilisateur
                </h3>
            </div>
            <?= $this->Form->create(null, ['class' => 'form-horizontal']) ?>
            <div class="card-body">
                <?= $this->Form->control('name', [
                    'class' => 'form-control',
                    'label' => ['text' => 'Nom', 'class' => 'form-label'],
                    'required' => true,
                    'placeholder' => 'Entrez le nom de l\'utilisateur'
                ]) ?>

                <?= $this->Form->control('email', [
                    'type' => 'email',
                    'class' => 'form-control',
                    'label' => ['text' => 'Email', 'class' => 'form-label'],
                    'required' => true,
                    'placeholder' => 'Entrez l\'adresse email'
                ]) ?>
            </div>
            <div class="card-footer">
                <?= $this->Form->button('Enregistrer l\'utilisateur', [
                    'class' => 'btn btn-primary',
                    'escape' => false
                ]) ?>
                <?= $this->Html->link(
                    '<i class="fas fa-times"></i> Annuler',
                    ['action' => 'index'],
                    ['class' => 'btn btn-default', 'escape' => false]
                ) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-lightbulb mr-2"></i>
                    Patron Use Case
                </h3>
            </div>
            <div class="card-body">
                <p>Lorsque vous soumettez ce formulaire :</p>
                <ol>
                    <li>Le <strong>Controller</strong> reçoit la requête</li>
                    <li>Le <strong>CreateUserUseCase</strong> est automatiquement injecté</li>
                    <li>Le use case valide les règles métier (unicité de l'email)</li>
                    <li>Une <strong>Entité Domaine</strong> est créée avec validation</li>
                    <li>Le <strong>Repository</strong> persiste l'entité</li>
                    <li>Toutes les couches restent découplées et testables</li>
                </ol>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    <strong>Note :</strong> La validation du domaine se fait dans l'entité, tandis que la logique de persistance est dans la couche infrastructure.
                </div>
            </div>
        </div>
    </div>
</div>
