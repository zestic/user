<?php
declare(strict_types=1);

namespace Zestic\User\Entity;

use Carbon\Carbon;
use Zend\Expressive\Authentication\UserInterface;

final class User implements UserInterface
{
    /** @var Carbon */
    private $createdAt;
    /** @var string */
    private $email;
    /** @var string */
    private $identity;
    /** @var Password */
    private $password;
    /** @var Carbon */
    private $updatedAt;
    /** @var string[] */
    private $userRoles = [];

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    public function setCreatedAt(Carbon $createdAt): User
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): User
    {
        $this->email = $email;

        return $this;
    }

    public function getIdentity(): string
    {
        return $this->identity;
    }

    public function setIdentity(string $identity): User
    {
        $this->identity = $identity;

        return $this;
    }

    public function getPassword(): Password
    {
        return $this->password;
    }

    public function setPassword(Password $password): User
    {
        $this->password = $password;

        return $this;
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(Carbon $updatedAt): User
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUserRoles(): array
    {
        return $this->userRoles;
    }
}