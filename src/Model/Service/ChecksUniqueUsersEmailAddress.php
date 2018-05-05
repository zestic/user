<?php
declare(strict_types=1);

namespace Zestic\User\Model\Service;

use Zestic\User\Model\EmailAddress;
use Zestic\User\Model\UserId;

interface ChecksUniqueUsersEmailAddress
{
    public function __invoke(EmailAddress $emailAddress): ?UserId;
}
