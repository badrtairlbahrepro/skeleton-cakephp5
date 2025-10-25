<?php
/**
 * User view template
 *
 * @var \App\View\AppView $this
 * @var \Domain\User\Entity\User $user
 */
$this->assign('title', 'User Details');
?>

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user mr-2"></i>
                    User Information
                </h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">ID</dt>
                    <dd class="col-sm-8"><?= h($user->getId()) ?></dd>

                    <dt class="col-sm-4">Name</dt>
                    <dd class="col-sm-8"><?= h($user->getName()) ?></dd>

                    <dt class="col-sm-4">Email</dt>
                    <dd class="col-sm-8"><?= h($user->getEmail()) ?></dd>

                    <dt class="col-sm-4">Created</dt>
                    <dd class="col-sm-8"><?= h($user->getCreatedAt()->format('Y-m-d H:i:s')) ?></dd>

                    <?php if ($user->getUpdatedAt()): ?>
                        <dt class="col-sm-4">Updated</dt>
                        <dd class="col-sm-8"><?= h($user->getUpdatedAt()->format('Y-m-d H:i:s')) ?></dd>
                    <?php endif; ?>
                </dl>
            </div>
            <div class="card-footer">
                <?= $this->Html->link(
                    '<i class="fas fa-arrow-left"></i> Back to List',
                    ['action' => 'index'],
                    ['class' => 'btn btn-default', 'escape' => false]
                ) ?>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-code mr-2"></i>
                    Domain Entity
                </h3>
            </div>
            <div class="card-body">
                <p>This user is represented as a rich domain entity with:</p>
                <ul>
                    <li>Business validation rules</li>
                    <li>Encapsulated state</li>
                    <li>Domain methods</li>
                    <li>No framework dependencies</li>
                </ul>
                <div class="alert alert-success">
                    <strong>Clean Architecture:</strong> The domain entity is completely independent of the framework and infrastructure!
                </div>
            </div>
        </div>
    </div>
</div>
