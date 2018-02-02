<?php
declare(strict_types=1);

namespace Zestic\User\Event;

use Assert\Assertion;
use Prooph\EventSourcing\AggregateChanged;
use Zestic\User\EmailAddress;
use Zestic\User\Password;
use Zestic\User\UserId;
use Zestic\User\Username;

final class UserWasRegistered extends AggregateChanged
{
    /**
     * @var EmailAddress
     */
    private $emailAddress;

    /**
     * @var string
     */
    private $password;

    /**
     * @var UserId
     */
    private $userId;

    /**
     * @var string
     */
    private $username;

    public static function withData(UserId $id, EmailAddress $emailAddress, $password, Username $username): UserWasRegistered
    {
        $event = self::occur(
            $userId->toString(),
            [
                'id' => $id,
                'identity' => $username->toString(),
                'password' => $password,
                'email' => $emailAddress->toString(),
            ]
        );

        $event->emailAddress = $emailAddress;
        $event->password = $password;
        $event->username = $username;
        $event->userId = $userId;

        return $event;
    }

    public function isCredentialsExpired(): bool
    {
        return $this->payload['credentialsExpired'] ?? false;
    }

    public function emailAddress(): EmailAddress
    {
        if ($this->emailAddress === null) {
            $this->emailAddress = EmailAddress::fromString($this->payload['email']);
        }

        return $this->emailAddress;
    }

    public function isEnabled(): bool
    {
        return $this->payload['enabled'] ?? true;
    }

    public function isExpired(): bool
    {
        return $this->payload['expired'] ?? false;
    }

    public function isLocked(): bool
    {
        return $this->payload['locked'] ?? false;
    }

    public function password(): string
    {
        if ($this->password === null) {
            $this->password = $this->payload['password'];
        }

        return $this->password;
    }

    public function roles(): array
    {
        return $this->payload['roles'] ?? [];
    }

    public function userId(): UserId
    {
        if ($this->userId === null) {
            $this->userId = UserId::fromString($this->aggregateId());
        }

        return $this->userId;
    }

    public function username(): Username
    {
        if ($this->username === null) {
            $this->username = Username::fromString($this->payload['username']);
        }

        return $this->username;
    }
}
