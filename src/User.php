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
    /**
     * @var UserId
     */
    private $userId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var EmailAddress
     */
    private $emailAddress;

    /**
     * @param UserId $userId
     * @param string $name
     * @param EmailAddress $emailAddress
     * @return User
     */
    public static function registerWithData(UserId $userId, $name, EmailAddress $emailAddress)
    {
        $self = new self();

        $self->assertName($name);

        $self->recordThat(UserWasRegistered::withData($userId, $name, $emailAddress));

        return $self;
    }

    /**
     * @return UserId
     */
    public function userId()
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return EmailAddress
     */
    public function emailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @param string $text
     * @param TodoId $todoId
     * @return Todo
     */
    public function postTodo($text, TodoId $todoId)
    {
        return Todo::post($text, $this->userId(), $todoId);
    }

    /**
     * @return string representation of the unique identifier of the aggregate root
     */
    protected function aggregateId()
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
        // TODO: Implement apply() method.
    }
}
