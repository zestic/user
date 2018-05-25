<?php
declare(strict_types=1);

namespace Zestic\User\CQRS\Service;

use Zestic\User\CQRS\EmailAddress;
use Zestic\User\CQRS\AggregateId;

interface ChecksUniqueUsersEmailAddress
{
    public function __invoke(EmailAddress $emailAddress): ?AggregateId;
}
