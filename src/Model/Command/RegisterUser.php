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

namespace Zestic\User\Model\Command;

use Assert\Assertion;
use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;
use Zestic\User\Model\EmailAddress;
use Zestic\User\Model\UserId;
use Zestic\User\Model\UserName;
use Zend\Validator\EmailAddress as EmailAddressValidator;

final class RegisterUser extends Command implements PayloadConstructable
{
    use PayloadTrait;

    public static function withData(string $userId, string $name, string $email): RegisterUser
    {
        return new self([
            'user_id' => $userId,
            'name' => $name,
            'email' => $email,
        ]);
    }

    public function userId(): UserId
    {
        return UserId::fromString($this->payload['user_id']);
    }

    public function name(): UserName
    {
        return UserName::fromString($this->payload['name']);
    }

    public function emailAddress(): EmailAddress
    {
        return EmailAddress::fromString($this->payload['email']);
    }

    protected function setPayload(array $payload): void
    {
        Assertion::keyExists($payload, 'user_id');
        Assertion::uuid($payload['user_id']);
        Assertion::keyExists($payload, 'name');
        Assertion::string($payload['name']);
        Assertion::keyExists($payload, 'email');
        $validator = new EmailAddressValidator();
        Assertion::true($validator->isValid($payload['email']));

        $this->payload = $payload;
    }
}
