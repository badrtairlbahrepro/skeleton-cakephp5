<?php

declare(strict_types=1);

namespace Application\UseCases\User;

use Domain\User\Entity\User;
use Domain\User\Repository\UserRepositoryInterface;

/**
 * Récupérer un utilisateur
 *
 * Cas d'usage applicatif pour chercher et retourner un utilisateur.
 * Gère les erreurs si l'utilisateur n'existe pas.
 */
class GetUserUseCase
{
    /**
     * Constructeur
     *
     * @param UserRepositoryInterface $repository Dépôt pour récupérer les utilisateurs
     */
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    /**
     * Exécuter le cas d'usage - Récupérer un utilisateur par ID
     *
     * @param int $id Identifiant de l'utilisateur
     * @return \Domain\User\Entity\User
     * @throws \RuntimeException
     */
    public function execute(int $id): User
    {
        $user = $this->repository->findById($id);

        if ($user === null) {
            throw new \RuntimeException('Utilisateur non trouvé');
        }

        return $user;
    }

    /**
     * Récupérer tous les utilisateurs
     *
     * @return array<\Domain\User\Entity\User>
     */
    public function getAll(): array
    {
        return $this->repository->findAll();
    }
}
