<?php
/**
 * Template de visualisation d'utilisateur
 *
 * @var \App\View\AppView $this
 * @var \Domain\User\Entity\User $user
 */
$this->assign('title', 'Détails de l\'utilisateur');
?>

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user mr-2"></i>
                    Informations de l'utilisateur
                </h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">ID</dt>
                    <dd class="col-sm-8"><?= h($user->getId()) ?></dd>

                    <dt class="col-sm-4">Nom</dt>
                    <dd class="col-sm-8"><?= h($user->getName()) ?></dd>

                    <dt class="col-sm-4">Email</dt>
                    <dd class="col-sm-8"><?= h($user->getEmail()) ?></dd>

                    <dt class="col-sm-4">Créé le</dt>
                    <dd class="col-sm-8"><?= h($user->getCreatedAt()->format('Y-m-d H:i:s')) ?></dd>

                    <?php if ($user->getUpdatedAt()): ?>
                        <dt class="col-sm-4">Modifié le</dt>
                        <dd class="col-sm-8"><?= h($user->getUpdatedAt()->format('Y-m-d H:i:s')) ?></dd>
                    <?php endif; ?>
                </dl>
            </div>
            <div class="card-footer">
                <?= $this->Html->link(
                    '<i class="fas fa-arrow-left"></i> Retour à la liste',
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
                    Entité Domaine
                </h3>
            </div>
            <div class="card-body">
                <p>Cet utilisateur est représenté comme une entité domaine riche avec :</p>
                <ul>
                    <li>Règles de validation métier</li>
                    <li>État encapsulé</li>
                    <li>Méthodes domaine</li>
                    <li>Aucune dépendance framework</li>
                </ul>
                <div class="alert alert-success">
                    <strong>Architecture Propre :</strong> L'entité domaine est complètement indépendante du framework et de l'infrastructure !
                </div>
            </div>
        </div>
    </div>
</div>
