<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Webauthn\PublicKeyCredentialUserEntity;

/**
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("name")
 */
class User extends PublicKeyCredentialUserEntity implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=255)
     */
    protected $id;

    /**
     * @ORM\Column(type="json")
     */
    protected $roles;

    public function __construct(string $id, string $name, string $displayName, ?string $icon = null, array $roles = [])
    {
        parent::__construct($name, $id, $displayName, $icon);
        $this->roles = $roles;
    }

    public function getRoles(): array
    {
        return array_unique($this->roles + ['ROLE_USER']);
    }

    public function getPassword(): void
    {
    }

    public function getSalt(): void
    {
    }

    public function getUsername(): ?string
    {
        return $this->name;
    }

    public function eraseCredentials(): void
    {
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string|null $icon
     */
    public function setIcon(?string $icon): void
    {
        $this->icon = $icon;
    }

    /**
     * @param string $displayName
     */
    public function setDisplayName(string $displayName): void
    {
        $this->displayName = $displayName;
    }


}
