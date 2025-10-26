<?php

declare(strict_types=1);

namespace Domain\User\Repository;

use Domain\User\Entity\User;

/**
 * Contrat pour l'accès aux utilisateurs
 *
 * Une interface qui définit comment persister et récupérer les utilisateurs.
 * C'est un "port" dans l'architecture hexagonale.
 */
interface UserRepositoryInterface
{
    /**
     * Chercher un utilisateur par son ID
     *
     * @param int $id
     * @return User|null
     */
    public function findById(int $id): ?User;

    /**
     * Chercher un utilisateur par son email
     *
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User;

    /**
     * Récupérer tous les utilisateurs
     *
     * @return array<int, User>
     */
    public function findAll(): array;

    /**
     * Enregistrer un utilisateur (créer ou mettre à jour)
     *
     * @param User $user
     * @return User
     */
    public function save(User $user): User;

    /**
     * Supprimer un utilisateur
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
