<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\CakeOrm;

use Domain\User\Entity\User;
use Domain\User\Repository\UserRepositoryInterface;
use Infrastructure\Persistence\CakeOrm\Table\UsersTable;

/**
 * Dépôt utilisateur - Infrastructure
 *
 * Implémentation concrète de l'interface UserRepositoryInterface
 * utilisant l'ORM de CakePHP pour la persistance.
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * Table ORM pour les utilisateurs
     */
    private UsersTable $table;

    /**
     * Constructeur
     */
    public function __construct()
    {
        // Instancier la table ORM directement
        $this->table = new UsersTable();
    }

    /**
     * Chercher un utilisateur par ID
     */
    public function findById(int $id): ?User
    {
        $entity = $this->table->find()
            ->where(['id' => $id])
            ->first();

        if ($entity === null) {
            return null;
        }

        return $this->toDomainEntity($entity);
    }

    /**
     * Chercher un utilisateur par email
     */
    public function findByEmail(string $email): ?User
    {
        $entity = $this->table->find()
            ->where(['email' => $email])
            ->first();

        if ($entity === null) {
            return null;
        }

        return $this->toDomainEntity($entity);
    }

    /**
     * Récupérer tous les utilisateurs
     * @return array<int, User>
     */
    public function findAll(): array
    {
        $entities = $this->table->find()->all();

        $users = [];
        foreach ($entities as $entity) {
            $users[] = $this->toDomainEntity($entity);
        }

        return $users;
    }

    /**
     * Enregistrer un utilisateur (créer ou mettre à jour)
     */
    public function save(User $user): User
    {
        $data = [
            'email' => $user->getEmail(),
            'name' => $user->getName(),
        ];

        if ($user->getId() !== null) {
            $entity = $this->table->get($user->getId());
            $entity = $this->table->patchEntity($entity, $data);
        } else {
            $entity = $this->table->newEntity($data);
        }

        $savedEntity = $this->table->saveOrFail($entity);

        return $this->toDomainEntity($savedEntity);
    }

    /**
     * Supprimer un utilisateur
     */
    public function delete(int $id): bool
    {
        $entity = $this->table->get($id);

        return $this->table->delete($entity);
    }

    /**
     * Convertir une ligne ORM en entité domaine
     * @param \Cake\ORM\Entity $entity Entity ORM
     */
    private function toDomainEntity($entity): User
    {
        return new User(
            $entity->email,
            $entity->name,
            $entity->id,
            $entity->created ? new \DateTimeImmutable($entity->created->format('Y-m-d H:i:s')) : null,
            $entity->modified ? new \DateTimeImmutable($entity->modified->format('Y-m-d H:i:s')) : null
        );
    }
}
