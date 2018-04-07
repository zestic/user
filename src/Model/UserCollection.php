<?php
declare(strict_types=1);

namespace Zestic\User\Model;

interface UserCollection
{
    public function save(User $user): void;

    public function get(UserId $userId): ?User;
}
