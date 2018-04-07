<?php
declare(strict_types=1);

namespace Zestic\User\Model;

interface Entity
{
    public function sameIdentityAs(Entity $other): bool;
}
