<?php
/**
 * Users index template
 *
 * @var \App\View\AppView $this
 * @var array<\Domain\User\Entity\User> $users
 */
$this->assign('title', 'Users List');
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users mr-2"></i>
                    All Users
                </h3>
                <div class="card-tools">
                    <?= $this->Html->link(
                        '<i class="fas fa-plus"></i> Add User',
                        ['action' => 'add'],
                        ['class' => 'btn btn-success btn-sm', 'escape' => false]
                    ) ?>
                </div>
            </div>
            <div class="card-body">
                <?php if (empty($users)): ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        No users found. <?= $this->Html->link('Create one now', ['action' => 'add']) ?>
                    </div>
                <?php else: ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= h($user->getId()) ?></td>
                                    <td><?= h($user->getName()) ?></td>
                                    <td><?= h($user->getEmail()) ?></td>
                                    <td><?= h($user->getCreatedAt()->format('Y-m-d H:i:s')) ?></td>
                                    <td>
                                        <?= $this->Html->link(
                                            '<i class="fas fa-eye"></i>',
                                            ['action' => 'view', $user->getId()],
                                            ['class' => 'btn btn-info btn-sm', 'escape' => false, 'title' => 'View']
                                        ) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle"></i>
                    Architecture Note
                </h3>
            </div>
            <div class="card-body">
                <p>This page demonstrates the hexagonal architecture in action:</p>
                <ul>
                    <li><strong>Controller</strong> (<code>UsersController</code>) receives the <code>GetUserUseCase</code> via automatic dependency injection</li>
                    <li><strong>Use Case</strong> (<code>GetUserUseCase</code>) orchestrates the business logic</li>
                    <li><strong>Repository Interface</strong> (<code>UserRepositoryInterface</code>) defines the contract in the domain layer</li>
                    <li><strong>Repository Implementation</strong> (<code>UserRepository</code>) provides the CakePHP ORM adapter in the infrastructure layer</li>
                    <li><strong>Domain Entity</strong> (<code>User</code>) contains the business logic and validation rules</li>
                </ul>
            </div>
        </div>
    </div>
</div>
