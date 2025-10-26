<?php

declare(strict_types=1);

namespace Domain\User\Entity;

/**
 * Entité Utilisateur
 *
 * Représente un utilisateur dans le domaine métier.
 * Contient la logique de validation des données utilisateur.
 */
class User
{
    private ?int $id;
    private string $email;
    private string $name;
    private \DateTimeImmutable $createdAt;
    private ?\DateTimeImmutable $updatedAt;

    /**
     * Constructeur
     *
     * @param string $email Email de l'utilisateur
     * @param string $name Nom de l'utilisateur
     * @param int|null $id ID de l'utilisateur
     * @param \DateTimeImmutable|null $createdAt Date de création
     * @param \DateTimeImmutable|null $updatedAt Date de mise à jour
     */
    public function __construct(
        string $email,
        string $name,
        ?int $id = null,
        ?\DateTimeImmutable $createdAt = null,
        ?\DateTimeImmutable $updatedAt = null
    ) {
        $this->validateEmail($email);
        $this->validateName($name);

        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
        $this->createdAt = $createdAt ?? new \DateTimeImmutable();
        $this->updatedAt = $updatedAt;
    }

    /**
     * Obtenir l'ID de l'utilisateur
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Obtenir l'email de l'utilisateur
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Obtenir le nom de l'utilisateur
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Obtenir la date de création
     *
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * Obtenir la date de mise à jour
     *
     * @return \DateTimeImmutable|null
     */
    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * Mettre à jour le nom de l'utilisateur
     *
     * @param string $name Nouveau nom
     * @return void
     */
    public function updateName(string $name): void
    {
        $this->validateName($name);
        $this->name = $name;
        $this->updatedAt = new \DateTimeImmutable();
    }

    /**
     * Mettre à jour l'email de l'utilisateur
     *
     * @param string $email Nouveau email
     * @return void
     */
    public function updateEmail(string $email): void
    {
        $this->validateEmail($email);
        $this->email = $email;
        $this->updatedAt = new \DateTimeImmutable();
    }

    /**
     * Valider le format de l'email
     *
     * @param string $email Email à valider
     * @return void
     * @throws \InvalidArgumentException
     */
    private function validateEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Format d\'email invalide');
        }
    }

    /**
     * Valider le nom
     *
     * @param string $name Nom à valider
     * @return void
     * @throws \InvalidArgumentException
     */
    private function validateName(string $name): void
    {
        if (empty(trim($name))) {
            throw new \InvalidArgumentException('Le nom ne peut pas être vide');
        }

        if (strlen($name) < 2) {
            throw new \InvalidArgumentException('Le nom doit comporter au moins 2 caractères');
        }
    }

    /**
     * Convertir en tableau
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'created_at' => $this->createdAt->format('Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt?->format('Y-m-d H:i:s'),
        ];
    }
}
