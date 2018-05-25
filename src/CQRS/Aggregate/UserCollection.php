<?php
declare(strict_types=1);

namespace Zestic\User\CQRS\Aggregate;

interface UserCollection
{
    public function save(User $user): void;

    public function get(AggregateId $userId): ?User;
}
