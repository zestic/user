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

    /**
     * @return UserId
     */
    public static function generate(): UserId
    {
        return new self(Uuid::uuid4());
    }

    /**
     * @param $userId
     * @return UserId
     */
    public static function fromString($userId): UserId
    {
        return new self(Uuid::fromString($userId));
    }

    /**
     * @param Uuid $uuid
     */
    private function __construct(UuidInterface $uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * @return string
     */
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
