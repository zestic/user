<?php
declare(strict_types=1);

namespace Zestic\User\Model\Persistence;

use Prooph\EventSourcing\Aggregate\AggregateRepository;
use Zestic\User\Model\User;
use Zestic\User\Model\UserCollection;
use Zestic\User\Model\UserId;

final class EventStoreUserCollection extends AggregateRepository implements UserCollection
{
    public function save(User $user): void
    {
        $this->saveAggregateRoot($user);
    }

    public function get(UserId $userId): ?User
    {
        return $this->getAggregateRoot($userId->toString());
    }
}
