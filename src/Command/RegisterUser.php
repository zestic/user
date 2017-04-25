<?php
declare(strict_types=1);

namespace Zestic\User\Command;

use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;
use Zestic\User\EmailAddress;
use Zestic\User\UserId;

final class RegisterUser extends Command implements PayloadConstructable
{
    use PayloadTrait;

    public static function withData($userId, $name, $email)
    {
        return new self(
            [
                'user_id' => (string)$userId,
                'name' => (string)$name,
                'email' => (string)$email
            ]
        );
    }

    public function userId()
    {
        return UserId::fromString($this->payload['user_id']);
    }

    public function name()
    {
        return $this->payload['name'];
    }

    public function emailAddress()
    {
        return EmailAddress::fromString($this->payload['email']);
    }
}
