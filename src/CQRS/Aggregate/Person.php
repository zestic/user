<?php
declare(strict_types=1);

namespace Zestic\User\CQRS\Aggregate;

use Prooph\EventSourcing\AggregateChanged;
use Prooph\EventSourcing\AggregateRoot;
use Zestic\User\CQRS\Event\PersonWasCreate;

class Person extends AggregateRoot
{

    public function id(): AggregateId
    {
        return $this->id;
    }

    protected function aggregateId(): string
    {
        // TODO: Implement aggregateId() method.
    }

    /**
     * Apply given event
     */
    protected function apply(AggregateChanged $event): void
    {
        // TODO: Implement apply() method.
    }
}
