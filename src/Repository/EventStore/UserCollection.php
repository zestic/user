<?php
declare(strict_types=1);

namespace Zestic\User\Repository\EventStore;

use Prooph\EventSourcing\Aggregate\AggregateRepository;
use Zestic\User\User;
use Zestic\User\UserCollectionInterface;
use Zestic\User\UserId;

final class UserCollection extends AggregateRepository implements UserCollectionInterface
{
    public function add(User $user)
    {
        $this->saveAggregateRoot($user);
    }

    public function get(UserId $userId): ?User
    {
        return $this->getAggregateRoot($userId->toString());
    }
}
