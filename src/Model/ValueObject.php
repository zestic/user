<?php
declare(strict_types=1);

namespace Zestic\User\Model;

interface ValueObject
{
    public function sameValueAs(ValueObject $object): bool;
}
