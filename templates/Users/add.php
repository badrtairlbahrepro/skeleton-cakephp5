<?php
/**
 * User add template
 *
 * @var \App\View\AppView $this
 */
$this->assign('title', 'Add User');
?>

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user-plus mr-2"></i>
                    Create New User
                </h3>
            </div>
            <?= $this->Form->create(null, ['class' => 'form-horizontal']) ?>
            <div class="card-body">
                <?= $this->Form->control('name', [
                    'class' => 'form-control',
                    'label' => ['text' => 'Name', 'class' => 'form-label'],
                    'required' => true,
                    'placeholder' => 'Enter user name'
                ]) ?>

                <?= $this->Form->control('email', [
                    'type' => 'email',
                    'class' => 'form-control',
                    'label' => ['text' => 'Email', 'class' => 'form-label'],
                    'required' => true,
                    'placeholder' => 'Enter email address'
                ]) ?>
            </div>
            <div class="card-footer">
                <?= $this->Form->button('Save User', [
                    'class' => 'btn btn-primary',
                    'escape' => false
                ]) ?>
                <?= $this->Html->link(
                    '<i class="fas fa-times"></i> Cancel',
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
                    Use Case Pattern
                </h3>
            </div>
            <div class="card-body">
                <p>When you submit this form:</p>
                <ol>
                    <li>The <strong>Controller</strong> receives the request</li>
                    <li>The <strong>CreateUserUseCase</strong> is automatically injected</li>
                    <li>The use case validates business rules (email uniqueness)</li>
                    <li>A <strong>Domain Entity</strong> is created with validation</li>
                    <li>The <strong>Repository</strong> persists the entity</li>
                    <li>All layers remain decoupled and testable</li>
                </ol>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    <strong>Note:</strong> Domain validation happens in the entity, while persistence logic is in the infrastructure layer.
                </div>
            </div>
        </div>
    </div>
</div>
