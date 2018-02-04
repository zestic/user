<?php
declare(strict_types=1);

namespace Zestic\User\Interactor;

class HashPassword
{
    public function handle(string $password): string
    {
        return password_hash($password, PASSWORD_ARGON2I);
    }
}