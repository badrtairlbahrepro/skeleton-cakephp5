<?php

declare(strict_types=1);

namespace Tests\TestCase\Application\UseCases\User;

use Application\UseCases\User\GetUserUseCase;
use Domain\User\Entity\User;
use Domain\User\Repository\UserRepositoryInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class GetUserUseCaseTest extends TestCase
{
    private GetUserUseCase $useCase;
    private UserRepositoryInterface&MockObject $repositoryMock;

    protected function setUp(): void
    {
        $this->repositoryMock = $this->createMock(UserRepositoryInterface::class);
        $this->useCase = new GetUserUseCase($this->repositoryMock);
    }

    /**
     * Test getting a user by ID successfully
     */
    public function testGetUserByIdSuccessfully(): void
    {
        $userId = 1;
        $expectedUser = new User('john@example.com', 'John Doe', $userId);

        $this->repositoryMock
            ->expects($this->once())
            ->method('findById')
            ->with($userId)
            ->willReturn($expectedUser);

        $result = $this->useCase->execute($userId);

        $this->assertEquals($userId, $result->getId());
        $this->assertEquals('john@example.com', $result->getEmail());
        $this->assertEquals('John Doe', $result->getName());
    }

    /**
     * Test getting a user that doesn't exist
     */
    public function testGetUserNotFound(): void
    {
        $userId = 999;

        $this->repositoryMock
            ->expects($this->once())
            ->method('findById')
            ->with($userId)
            ->willReturn(null);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Utilisateur non trouvé');

        $this->useCase->execute($userId);
    }

    /**
     * Test getting all users
     */
    public function testGetAllUsers(): void
    {
        $users = [
            new User('john@example.com', 'John Doe', 1),
            new User('jane@example.com', 'Jane Doe', 2),
            new User('bob@example.com', 'Bob Smith', 3),
        ];

        $this->repositoryMock
            ->expects($this->once())
            ->method('findAll')
            ->willReturn($users);

        $result = $this->useCase->getAll();

        $this->assertCount(3, $result);
        $this->assertEquals('john@example.com', $result[0]->getEmail());
        $this->assertEquals('jane@example.com', $result[1]->getEmail());
        $this->assertEquals('bob@example.com', $result[2]->getEmail());
    }

    /**
     * Test getting all users when empty
     */
    public function testGetAllUsersEmpty(): void
    {
        $this->repositoryMock
            ->expects($this->once())
            ->method('findAll')
            ->willReturn([]);

        $result = $this->useCase->getAll();

        $this->assertCount(0, $result);
        $this->assertIsArray($result);
    }

    /**
     * Test repository is called with correct user ID
     */
    public function testRepositoryCalledWithCorrectId(): void
    {
        $userId = 42;
        $user = new User('test@example.com', 'Test User', $userId);

        $this->repositoryMock
            ->expects($this->once())
            ->method('findById')
            ->with($userId)
            ->willReturn($user);

        $this->useCase->execute($userId);
    }

    /**
     * Test multiple calls to getAll
     */
    public function testMultipleCallsToGetAll(): void
    {
        $firstCall = [new User('first@example.com', 'First', 1)];
        $secondCall = [
            new User('first@example.com', 'First', 1),
            new User('second@example.com', 'Second', 2),
        ];

        $this->repositoryMock
            ->expects($this->exactly(2))
            ->method('findAll')
            ->willReturnOnConsecutiveCalls($firstCall, $secondCall);

        $result1 = $this->useCase->getAll();
        $result2 = $this->useCase->getAll();

        $this->assertCount(1, $result1);
        $this->assertCount(2, $result2);
    }
}
