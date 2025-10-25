<?php

declare(strict_types=1);

namespace Tests\TestCase\Application\UseCases\User;

use Application\UseCases\User\CreateUserUseCase;
use Domain\User\Entity\User;
use Domain\User\Repository\UserRepositoryInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class CreateUserUseCaseTest extends TestCase
{
    private CreateUserUseCase $useCase;
    private UserRepositoryInterface&MockObject $repositoryMock;

    protected function setUp(): void
    {
        $this->repositoryMock = $this->createMock(UserRepositoryInterface::class);
        $this->useCase = new CreateUserUseCase($this->repositoryMock);
    }

    /**
     * Teste la création d'un utilisateur avec succès
     */
    public function testCreateUserSuccessfully(): void
    {
        $email = 'john@example.com';
        $name = 'John Doe';

        // Simuler les méthodes du repository
        $this->repositoryMock
            ->expects($this->once())
            ->method('findByEmail')
            ->with($email)
            ->willReturn(null);

        $savedUser = new User($email, $name, 1);
        $this->repositoryMock
            ->expects($this->once())
            ->method('save')
            ->willReturn($savedUser);

        // Exécuter le cas d'usage
        $result = $this->useCase->execute($email, $name);

        // Vérifications
        $this->assertEquals($email, $result->getEmail());
        $this->assertEquals($name, $result->getName());
        $this->assertEquals(1, $result->getId());
    }

    /**
     * Teste la création d'un utilisateur avec un email dupliqué
     */
    public function testCreateUserWithDuplicateEmail(): void
    {
        $email = 'john@example.com';
        $name = 'John Doe';

        // Simuler le repository pour retourner un utilisateur existant
        $existingUser = new User($email, 'Existing User', 1);
        $this->repositoryMock
            ->expects($this->once())
            ->method('findByEmail')
            ->with($email)
            ->willReturn($existingUser);

        // Attendre que save ne soit jamais appelé
        $this->repositoryMock
            ->expects($this->never())
            ->method('save');

        // Attendre une exception
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Utilisateur avec cet email existe déjà');

        $this->useCase->execute($email, $name);
    }

    /**
     * Teste la création d'un utilisateur avec un email invalide
     */
    public function testCreateUserWithInvalidEmail(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Format d\'email invalide');

        $this->useCase->execute('invalid-email', 'John Doe');
    }

    /**
     * Teste la création d'un utilisateur avec un nom vide
     */
    public function testCreateUserWithEmptyName(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Le nom ne peut pas être vide');

        $this->useCase->execute('john@example.com', '');
    }

    /**
     * Teste la création d'un utilisateur avec un nom trop court
     */
    public function testCreateUserWithNameTooShort(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Le nom doit comporter au moins 2 caractères');

        $this->useCase->execute('john@example.com', 'A');
    }

    /**
     * Teste que le repository est appelé avec les bons paramètres
     */
    public function testRepositoryCalledWithCorrectParameters(): void
    {
        $email = 'jane@example.com';
        $name = 'Jane Doe';

        $this->repositoryMock
            ->expects($this->once())
            ->method('findByEmail')
            ->with($email)
            ->willReturn(null);

        $this->repositoryMock
            ->expects($this->once())
            ->method('save')
            ->with($this->callback(function ($user) use ($email, $name) {
                return $user->getEmail() === $email && $user->getName() === $name;
            }))
            ->willReturn(new User($email, $name, 1));

        $this->useCase->execute($email, $name);
    }
}
