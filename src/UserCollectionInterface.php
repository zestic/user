<?php
declare(strict_types=1);

namespace Zestic\User;

interface UserCollectionInterface
{
    /**
     * @param User $user
     * @return void
     */
    public function add(User $user);

    /**
     * @param UserId $userId
     * @return User
     */
    public function get(UserId $userId);
}
