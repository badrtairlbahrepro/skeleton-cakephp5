<?php

declare(strict_types=1);

namespace Application\UseCases\User;

use Domain\User\Entity\User;
use Domain\User\Repository\UserRepositoryInterface;

/**
 * Créer un nouvel utilisateur
 *
 * Cas d'usage applicatif qui gère la logique métier de création d'utilisateur.
 * Valide les données et les enregistre via le dépôt.
 */
class CreateUserUseCase
{
    /**
     * Constructeur
     *
     * @param UserRepositoryInterface $repository Dépôt pour la persistance
     */
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    /**
     * Exécuter le cas d'usage
     *
     * @param string $email Email de l'utilisateur
     * @param string $name Nom de l'utilisateur
     * @return \Domain\User\Entity\User
     * @throws \RuntimeException
     */
    public function execute(string $email, string $name): User
    {
        // Vérifier si l'utilisateur existe déjà
        $existingUser = $this->repository->findByEmail($email);
        if ($existingUser !== null) {
            throw new \RuntimeException('Utilisateur avec cet email existe déjà');
        }

        // Créer une nouvelle entité utilisateur
        $user = new User($email, $name);

        // Persister l'utilisateur
        return $this->repository->save($user);
    }
}
