<?php
declare(strict_types=1);

namespace Zestic\User\Event;

use Assert\Assertion;
use Prooph\EventSourcing\AggregateChanged;
use Zestic\User\EmailAddress;
use Zestic\User\UserId;

final class UserWasRegistered extends AggregateChanged
{
    /**
     * @var UserId
     */
    private $userId;

    /**
     * @var string
     */
    private $username;

    /**
     * @var EmailAddress
     */
    private $emailAddress;

    /**
     * @param UserId $userId
     * @param string $name
     * @param EmailAddress $emailAddress
     * @return UserWasRegistered
     */
    public static function withData(UserId $userId, $name, EmailAddress $emailAddress)
    {
        Assertion::string($name);

        $event = self::occur(
            $userId->toString(),
            [
                'name' => $name,
                'email' => $emailAddress->toString(),
            ]
        );

        $event->userId = $userId;
        $event->username = $name;
        $event->emailAddress = $emailAddress;

        return $event;
    }

    /**
     * @return UserId
     */
    public function userId()
    {
        if ($this->userId === null) {
            $this->userId = UserId::fromString($this->aggregateId());
        }

        return $this->userId;
    }

    /**
     * @return string
     */
    public function name()
    {
        if ($this->username === null) {
            $this->username = $this->payload['name'];
        }
        return $this->username;
    }

    /**
     * @return EmailAddress
     */
    public function emailAddress()
    {
        if ($this->emailAddress === null) {
            $this->emailAddress = EmailAddress::fromString($this->payload['email']);
        }
        return $this->emailAddress;
    }
}
