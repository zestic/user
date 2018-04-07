<?php
/**
 * This file is part of prooph/proophessor-do.
 * (c) 2014-2018 prooph software GmbH <contact@prooph.de>
 * (c) 2015-2018 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Zestic\User\Model\Service;

use Zestic\User\Model\EmailAddress;
use Zestic\User\Model\UserId;

interface ChecksUniqueUsersEmailAddress
{
    public function __invoke(EmailAddress $emailAddress): ?UserId;
}
