<?php
declare(strict_types=1);

namespace Zestic\User\CQRS\EventStore\Repository;

use Prooph\EventSourcing\Aggregate\AggregateRepository;

final class UserEventStore extends AggregateRepository
{
    public function save($user): void
    {
        $this->saveAggregateRoot($user);
    }

    public function get($id)
    {
        return $this->getAggregateRoot($id);
    }
}
