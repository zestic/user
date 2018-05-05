<?php
declare(strict_types=1);

namespace Zestic\User\Model\Command;

use Common\Communique\CommuniqueConstructableInterface;
use Common\Communique\CommuniqueConstructableTrait;
use Prooph\Common\Messaging\Command;
use Zestic\User\Model\EmailAddress;
use Zestic\User\Model\UserId;
use Zestic\User\Model\UserName;

final class RegisterUser extends Command implements CommuniqueConstructableInterface
{
    use CommuniqueConstructableTrait;

    public function userId(): UserId
    {
        return UserId::fromString($this->payload['id']);
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
