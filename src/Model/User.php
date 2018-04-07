<?php
declare(strict_types=1);

namespace Zestic\User\Model;

use Prooph\EventSourcing\AggregateChanged;
use Prooph\EventSourcing\AggregateRoot;
use Zestic\User\Model\Event\UserWasRegistered;
use Zestic\User\Model\Event\UserWasRegisteredAgain;

final class User extends AggregateRoot implements Entity
{
    /**
     * @var UserId
     */
    private $userId;

    /**
     * @var UserName
     */
    private $name;

    /**
     * @var EmailAddress
     */
    private $emailAddress;

    public static function registerWithData(
        UserId $userId,
        UserName $name,
        EmailAddress $emailAddress
    ): User {
        $self = new self();

        $self->recordThat(UserWasRegistered::withData($userId, $name, $emailAddress));

        return $self;
    }

    public function registerAgain(UserName $name): void
    {
        $this->recordThat(UserWasRegisteredAgain::withData($this->userId, $name, $this->emailAddress));
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function name(): UserName
    {
        return $this->name;
    }

    public function emailAddress(): EmailAddress
    {
        return $this->emailAddress;
    }

    protected function aggregateId(): string
    {
        return $this->userId->toString();
    }

    protected function whenUserWasRegistered(UserWasRegistered $event): void
    {
        $this->userId = $event->userId();
        $this->name = $event->name();
        $this->emailAddress = $event->emailAddress();
    }

    protected function whenUserWasRegisteredAgain(UserWasRegisteredAgain $event): void
    {
    }

    public function sameIdentityAs(Entity $other): bool
    {
        return get_class($this) === get_class($other) && $this->userId->sameValueAs($other->userId);
    }

    /**
     * Apply given event
     */
    protected function apply(AggregateChanged $e): void
    {
        $handler = $this->determineEventHandlerMethodFor($e);

        if (! method_exists($this, $handler)) {
            throw new \RuntimeException(sprintf(
                'Missing event handler method %s for aggregate root %s',
                $handler,
                get_class($this)
            ));
        }

        $this->{$handler}($e);
    }

    protected function determineEventHandlerMethodFor(AggregateChanged $e): string
    {
        return 'when' . implode(array_slice(explode('\\', get_class($e)), -1));
    }
}
