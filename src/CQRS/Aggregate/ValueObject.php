<?php
declare(strict_types=1);

namespace Zestic\User\CQRS\Aggregate;

interface ValueObject
{
    public function sameValueAs(ValueObject $object): bool;
}
