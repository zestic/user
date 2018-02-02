<?php
declare(strict_types=1);

namespace Zestic\User\Command;

use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;
use Zestic\User\EmailAddress;
use Zestic\User\Password;
use Zestic\User\UserId;
use Zestic\User\Username;

final class RegisterUserCommand extends Command implements PayloadConstructable
{
    use PayloadTrait;

    public static function withData($userId, $email, $password, $username)
    {
        return new self(
            [
                'id'  => (string)$userId,
                'email'    => (string)$email,
                'password' => (string)$password,
                'identity' => (string)$username,
            ]
        );
    }

    public function userId()
    {
        return UserId::fromString($this->payload['user_id']);
    }

    public function password()
    {
        return $this->payload['password'];
    }

    public function username()
    {
        return Username::fromString($this->payload['username']);
    }

    public function emailAddress()
    {
        return EmailAddress::fromString($this->payload['email']);
    }
}
