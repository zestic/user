<?php
declare(strict_types=1);

namespace Zestic\User\CQRS\Command;

use Common\Communique\CommuniqueConstructableInterface;
use Common\Communique\CommuniqueConstructableTrait;
use Prooph\Common\Messaging\Command;
use Zestic\User\CQRS\Aggregate\AggregateId;
use Zestic\User\CQRS\Aggregate\EmailAddress;
use Zestic\User\CQRS\Aggregate\UserName;

final class RegisterUser extends Command implements CommuniqueConstructableInterface
{
    use CommuniqueConstructableTrait;

    public function userId(): AggregateId
    {
        return AggregateId::fromString($this->payload['id']);
    }

    public function name(): UserName
    {
        return UserName::fromString($this->payload['username']);
    }

    public function emailAddress(): EmailAddress
    {
        return EmailAddress::fromString($this->payload['email']);
    }
}
