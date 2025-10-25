<?php

declare(strict_types=1);

namespace Tests\TestCase\Domain\User\Entity;

use Domain\User\Entity\User;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * Test creating a user with valid data
     */
    public function testCreateUserWithValidData(): void
    {
        $user = new User('john@example.com', 'John Doe');

        $this->assertNull($user->getId());
        $this->assertEquals('john@example.com', $user->getEmail());
        $this->assertEquals('John Doe', $user->getName());
        $this->assertNotNull($user->getCreatedAt());
        $this->assertNull($user->getUpdatedAt());
    }

    /**
     * Test creating a user with all parameters
     */
    public function testCreateUserWithAllParameters(): void
    {
        $now = new \DateTimeImmutable();
        $updated = new \DateTimeImmutable('+1 day');
        $user = new User('jane@example.com', 'Jane Doe', 1, $now, $updated);

        $this->assertEquals(1, $user->getId());
        $this->assertEquals('jane@example.com', $user->getEmail());
        $this->assertEquals('Jane Doe', $user->getName());
        $this->assertEquals($now, $user->getCreatedAt());
        $this->assertEquals($updated, $user->getUpdatedAt());
    }

    /**
     * Test user creation with invalid email
     */
    public function testCreateUserWithInvalidEmail(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Format d\'email invalide');

        new User('not-an-email', 'John Doe');
    }

    /**
     * Test user creation with invalid email format
     */
    public function testCreateUserWithEmailNoAt(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Format d\'email invalide');

        new User('johnexample.com', 'John Doe');
    }

    /**
     * Test user creation with empty name
     */
    public function testCreateUserWithEmptyName(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Le nom ne peut pas être vide');

        new User('john@example.com', '');
    }

    /**
     * Test user creation with name too short
     */
    public function testCreateUserWithNameTooShort(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Le nom doit comporter au moins 2 caractères');

        new User('john@example.com', 'A');
    }

    /**
     * Test getting user email
     */
    public function testGetEmail(): void
    {
        $user = new User('john@example.com', 'John Doe');
        $this->assertEquals('john@example.com', $user->getEmail());
    }

    /**
     * Test getting user name
     */
    public function testGetName(): void
    {
        $user = new User('john@example.com', 'John Doe');
        $this->assertEquals('John Doe', $user->getName());
    }

    /**
     * Test getting created at
     */
    public function testGetCreatedAt(): void
    {
        $now = new \DateTimeImmutable();
        $user = new User('john@example.com', 'John Doe', null, $now);
        $this->assertEquals($now, $user->getCreatedAt());
    }

    /**
     * Test getting updated at
     */
    public function testGetUpdatedAt(): void
    {
        $updated = new \DateTimeImmutable('+1 day');
        $user = new User('john@example.com', 'John Doe', null, null, $updated);
        $this->assertEquals($updated, $user->getUpdatedAt());
    }

    /**
     * Test email validation with various invalid formats
     */
    public function testEmailValidationWithVariousInvalidFormats(): void
    {
        $invalidEmails = [
            'plainaddress',
            '@example.com',
            'john@',
        ];

        foreach ($invalidEmails as $email) {
            $this->expectException(InvalidArgumentException::class);
            new User($email, 'John Doe');
        }
    }

    /**
     * Test valid email formats
     */
    public function testValidEmailFormats(): void
    {
        $validEmails = [
            'simple@example.com',
            'user+tag@example.co.uk',
            'john.doe@example.com',
            'test123@test-domain.com',
        ];

        foreach ($validEmails as $email) {
            $user = new User($email, 'John Doe');
            $this->assertEquals($email, $user->getEmail());
        }
    }

    /**
     * Test user to array
     */
    public function testUserToArray(): void
    {
        $user = new User('john@example.com', 'John Doe', 1);
        $array = $user->toArray();

        $this->assertEquals(1, $array['id']);
        $this->assertEquals('john@example.com', $array['email']);
        $this->assertEquals('John Doe', $array['name']);
        $this->assertArrayHasKey('created_at', $array);
        $this->assertArrayHasKey('updated_at', $array);
    }
}
