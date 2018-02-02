<?php
declare(strict_types=1);

namespace Zestic\User\Entity;

use Zend\Expressive\Authentication\UserInterface;

final class User implements UserInterface
{
    /** @var string */
    private $email;
    /** @var string */
    private $identity;
    /** @var string[] */
    private $userRoles = [];

    public function getIdentity(): string
    {
        return $this->identity;
    }

    public function getUserRoles(): array
    {
        return $this->userRoles;
    }
}