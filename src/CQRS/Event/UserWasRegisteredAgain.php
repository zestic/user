<?php
/**
 * This file is part of prooph/proophessor-do.
 * (c) 2014-2018 prooph software GmbH <contact@prooph.de>
 * (c) 2015-2018 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Zestic\User\CQRS\Event;

use Prooph\EventSourcing\AggregateChanged;
use Zestic\User\CQRS\EmailAddress;
use Zestic\User\CQRS\AggregateId;
use Zestic\User\CQRS\UserName;

final class UserWasRegisteredAgain extends AggregateChanged
{
    /**
     * @var AggregateId
     */
    private $userId;

    /**
     * @var UserName
     */
    private $username;

    /**
     * @var EmailAddress
     */
    private $emailAddress;

    public static function withData(AggregateId $userId, UserName $name, EmailAddress $emailAddress): UserWasRegisteredAgain
    {
        /** @var self $event */
        $event = self::occur($userId->toString(), [
            'name' => $name->toString(),
            'email' => $emailAddress->toString(),
        ]);

        $event->userId = $userId;
        $event->username = $name;
        $event->emailAddress = $emailAddress;

        return $event;
    }

    public function userId(): AggregateId
    {
        if (null === $this->userId) {
            $this->userId = AggregateId::fromString($this->aggregateId());
        }

        return $this->userId;
    }

    public function name(): UserName
    {
        if (null === $this->username) {
            $this->username = UserName::fromString($this->payload['name']);
        }

        return $this->username;
    }

    public function emailAddress(): EmailAddress
    {
        if (null === $this->emailAddress) {
            $this->emailAddress = EmailAddress::fromString($this->payload['email']);
        }

        return $this->emailAddress;
    }
}
