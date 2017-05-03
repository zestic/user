<?php
declare(strict_types=1);

namespace Zestic\User;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class UserId
{
    /**
     * @var UuidInterface
     */
    private $uuid;

    public static function generate(): UserId
    {
        return new self(Uuid::uuid4());
    }

    public static function fromString(string $userId): UserId
    {
        return new self(Uuid::fromString($userId));
    }

    private function __construct(UuidInterface $uuid)
    {
        $this->uuid = $uuid;
    }

    public function getBytes(): string
    {
        return $this->uuid->getBytes();
    }

    public function toString(): string
    {
        return $this->uuid->toString();
    }

    /**
     * @param UserId $other
     * @return bool
     */
    public function sameValueAs(UserId $other): bool
    {
        return $this->toString() === $other->toString();
    }
}
