<?php
declare(strict_types=1);

namespace Zestic\User\CQRS\Persistence;

use Prooph\EventSourcing\Aggregate\AggregateRepository;
use Zestic\User\CQRS\Aggregate\Person;

final class PersonEventStore extends AggregateRepository
{
    public function save(Person $person): void
    {
        $this->saveAggregateRoot($person);
    }

    public function get($id): ?Person
    {
        return $this->getAggregateRoot($id);
    }
}
