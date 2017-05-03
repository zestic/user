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
    /** @var EmailAddress */
    private $emailAddress;

    /** @var Password */
    private $password;

    /** @var UserId */
    private $userId;

    /** @var Username */
    private $username;

    public static function registerWithData(UserId $userId, EmailAddress $emailAddress, $password, Username $username): User
    {
        $self = new self();

        $self->recordThat(UserWasRegistered::withData($userId, $emailAddress, $password, $username));

        return $self;
    }

    public function emailAddress(): EmailAddress
    {
        return $this->emailAddress;
    }

    public function password(): Password
    {
        return $this->password;
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function username(): Username
    {
        return $this->username;
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
        $this->password = $event->password();
        $this->username = $event->username();
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
