<?php
declare(strict_types=1);

namespace Zestic\User\Exception;

use Zestic\User\UserId;

/**
 * Class UserNotFound
 *
 * @package Zestic\User
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class UserNotFound extends \InvalidArgumentException
{
    /**
     * @param UserId $userId
     * @return UserNotFound
     */
    public static function withUserId(UserId $userId)
    {
        return new self(sprintf('User with id %s cannot be found.', $userId->toString()));
    }
}
