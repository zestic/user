<?php
declare(strict_types=1);

namespace Zestic\User;

use Zestic\User\Exception\InvalidEmailAddress;

final class EmailAddress
{
    /**
     * @var string
     */
    private $email;

    /**
     * @param string $email
     * @return EmailAddress
     */
    public static function fromString(string $email)
    {
        return new self($email);
    }

    /**
     * @param string $emailAddress
     */
    private function __construct(string $emailAddress)
    {
        if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
            throw InvalidEmailAddress::reason('filter_var returned false');
        }

        $this->email = $emailAddress;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->email;
    }

    /**
     * @param EmailAddress $other
     * @return bool
     */
    public function sameValueAs(EmailAddress $other)
    {
        return $this->toString() === $other->toString();
    }
}
