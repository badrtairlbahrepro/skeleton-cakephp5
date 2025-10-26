<?php
/**
 * Template d'index des utilisateurs
 *
 * @var \App\View\AppView $this
 * @var array<\Domain\User\Entity\User> $users
 */
$this->assign('title', 'Liste des utilisateurs');
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users mr-2"></i>
                    Tous les utilisateurs
                </h3>
                <div class="card-tools">
                    <?= $this->Html->link(
                        '<i class="fas fa-plus"></i> Ajouter un utilisateur',
                        ['action' => 'add'],
                        ['class' => 'btn btn-success btn-sm', 'escape' => false]
                    ) ?>
                </div>
            </div>
            <div class="card-body">
                <?php if (empty($users)): ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        Aucun utilisateur trouvé. <?= $this->Html->link('En créer un maintenant', ['action' => 'add']) ?>
                    </div>
                <?php else: ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Créé le</th>
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
                                            ['class' => 'btn btn-info btn-sm', 'escape' => false, 'title' => 'Voir']
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
                    Note sur l'architecture
                </h3>
            </div>
            <div class="card-body">
                <p>Cette page démontre l'architecture hexagonale en action :</p>
                <ul>
                    <li><strong>Controller</strong> (<code>UsersController</code>) reçoit le <code>GetUserUseCase</code> via l'injection de dépendances automatique</li>
                    <li><strong>Use Case</strong> (<code>GetUserUseCase</code>) orchestre la logique métier</li>
                    <li><strong>Interface de Repository</strong> (<code>UserRepositoryInterface</code>) définit le contrat dans la couche domaine</li>
                    <li><strong>Implémentation du Repository</strong> (<code>UserRepository</code>) fournit l'adaptateur CakePHP ORM dans la couche infrastructure</li>
                    <li><strong>Entité Domaine</strong> (<code>User</code>) contient la logique métier et les règles de validation</li>
                </ul>
            </div>
        </div>
    </div>
</div>
