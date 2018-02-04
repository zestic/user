<?php
declare(strict_types=1);

namespace Zestic\User\Interactor;

use Zestic\User\Entity\Password;

final class VerifyPassword
{
    public function handle($attempt, Password $password): bool
    {
        return password_verify($attempt, $password->toString());
    }
}