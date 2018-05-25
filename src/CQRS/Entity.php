<?php
declare(strict_types=1);

namespace Zestic\User\CQRS;

interface Entity
{
    public function sameIdentityAs(Entity $other): bool;
}
