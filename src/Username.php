<?php
declare(strict_types=1);

namespace Zestic\User;

use Zestic\User\Interactor\Canonicalizer;

final class Username
{
    /** @var string */
    private $canonical;

    /** @var string */
    private $username;

    public static function fromString(string $username): Username
    {
        return new self($username);
    }

    private function __construct(string $username)
    {
        $this->username = $username;
        $this->canonical = Canonicalizer::canonicalize($username);
    }

    public function canonicalized(): string
    {
        return $this->canonical;
    }

    public function toString(): string
    {
        return $this->username;
    }

    public function sameValueAs(Username $other): bool
    {
        return $this->toString() === $other->toString();
    }
}
