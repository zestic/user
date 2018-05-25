<?php
declare(strict_types=1);

namespace Zestic\User\CQRS\Persistence;

use Prooph\EventSourcing\Aggregate\AggregateRepository;
use Zestic\User\CQRS\Aggregate\AggregateId;
use Zestic\User\CQRS\Aggregate\Person;
use Zestic\User\CQRS\UserCollection;

final class EventStorePersonCollection extends AggregateRepository implements PersonCollection
{
    public function save(Person $person): void
    {
        $this->saveAggregateRoot($user);
    }

    public function get(AggregateId $id): ?Person
    {
        return $this->getAggregateRoot($userId->toString());
    }
}
