<?php
declare(strict_types=1);

namespace Zestic\User\CQRS\Aggregate;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class AggregateId implements ValueObject
{
    /**
     * @var UuidInterface
     */
    private $uuid;

    public static function generate(): AggregateId
    {
        return new self(Uuid::uuid4());
    }

    public static function fromString(string $userId): AggregateId
    {
        return new self(Uuid::fromString($userId));
    }

    private function __construct(UuidInterface $uuid)
    {
        $this->uuid = $uuid;
    }

    public function toString(): string
    {
        return $this->uuid->toString();
    }

    public function sameValueAs(ValueObject $other): bool
    {
        return get_class($this) === get_class($other) && $this->uuid->equals($other->uuid);
    }
}
