<?php

declare(strict_types=1);

namespace Infrastructure\DependencyInjection;

use Application\UseCases\User\CreateUserUseCase;
use Application\UseCases\User\GetUserUseCase;
use Cake\Core\ContainerInterface;
use Domain\User\Repository\UserRepositoryInterface;
use Infrastructure\Persistence\CakeOrm\UserRepository;

/**
 * Enregistrement des dépendances
 *
 * Configure le conteneur DI de CakePHP pour l'injection automatique.
 * Mappe les interfaces aux implémentations concrètes.
 */
class ServiceProvider
{
    /**
     * Le conteneur de dépendances
     */
    private ContainerInterface $container;

    /**
     * Constructeur
     *
     * @param ContainerInterface $container Le conteneur de dépendances
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Enregistrer les services
     *
     * @param ContainerInterface $container Le conteneur de dépendances
     * @return void
     */
    public function register(ContainerInterface $container): void
    {
        // Enregistrer les dépôts (Infrastructure → Domaine)
        $container->add(UserRepositoryInterface::class, UserRepository::class);

        // Enregistrer les cas d'usage (Couche Applicative)
        $container->add(CreateUserUseCase::class)
            ->addArgument(UserRepositoryInterface::class);

        $container->add(GetUserUseCase::class)
            ->addArgument(UserRepositoryInterface::class);

        // Ajouter d'autres enregistrements de services ici au besoin
    }
}
