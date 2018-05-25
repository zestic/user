<?php
declare(strict_types=1);

namespace Zestic\User\CQRS\Persistence;

use Prooph\EventSourcing\Aggregate\AggregateRepository;
use Zestic\User\CQRS\User;
use Zestic\User\CQRS\UserCollection;
use Zestic\User\CQRS\AggregateId;

final class EventStoreUserCollection extends AggregateRepository implements UserCollection
{
    public function save(User $user): void
    {
        $this->saveAggregateRoot($user);
    }

    public function get(AggregateId $userId): ?User
    {
        return $this->getAggregateRoot($userId->toString());
    }
}
