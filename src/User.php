<?php
declare(strict_types=1);

namespace Zestic\User;

use Assert\Assertion;
use Prooph\EventSourcing\AggregateChanged;
use Prooph\EventSourcing\AggregateRoot;
use Prooph\ProophessorDo\Model\Todo\Todo;
use Prooph\ProophessorDo\Model\Todo\TodoId;
use Zestic\User\Event\UserWasRegistered;

final class User extends AggregateRoot
{
    /** @var UserId */
    private $userId;

    /** @var string */
    private $name;

    /** @var EmailAddress */
    private $emailAddress;

    public static function registerWithData(UserId $userId, $name, EmailAddress $emailAddress): User
    {
        $self = new self();

        $self->assertName($name);

        $self->recordThat(UserWasRegistered::withData($userId, $name, $emailAddress));

        return $self;
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function name(): string
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

    /**
     * @param UserWasRegistered $event
     */
    protected function whenUserWasRegistered(UserWasRegistered $event)
    {
        $this->userId = $event->userId();
        $this->name = $event->name();
        $this->emailAddress = $event->emailAddress();
    }

    /**
     * @param string $name
     * @throws Exception\InvalidName
     */
    private function assertName($name)
    {
        try {
            Assertion::string($name);
            Assertion::notEmpty($name);
        } catch (\Exception $e) {
            throw Exception\InvalidName::reason($e->getMessage());
        }
    }

    /**
     * Apply given event
     */
    protected function apply(AggregateChanged $event): void
    {
        $method = 'when' . substr(strrchr(get_class($event), '\\'), 1);

        $this->$method($event);
    }
}
