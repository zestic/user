<?php
declare(strict_types=1);

namespace Zestic\User;

use Zestic\User\Exception\InvalidEmailAddress;
use Zestic\User\Interactor\Canonicalizer;

final class EmailAddress
{
    /** @var string */
    private $canonical;

    /** @var string */
    private $email;

    public static function fromString(string $email): EmailAddress
    {
        return new self($email);
    }

    private function __construct(string $emailAddress)
    {
        if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
            throw InvalidEmailAddress::reason('filter_var returned false');
        }

        $this->email = $emailAddress;
        $this->canonical = Canonicalizer::canonicalize($emailAddress);
    }

    public function canonicalized(): string
    {
        return $this->canonical;
    }

    public function toString(): string
    {
        return $this->email;
    }

    public function sameValueAs(EmailAddress $other): bool
    {
        return $this->toString() === $other->toString();
    }
}
