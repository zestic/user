<?php
declare(strict_types=1);

namespace Zestic\User\Exception;

/**
 * Class InvalidName
 *
 * @package Zestic\User\Exception
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class InvalidEmailAddress extends \InvalidArgumentException
{
    /**
     * @param string $msg
     * @return InvalidEmailAddress
     */
    public static function reason($msg)
    {
        return new self('Invalid email because ' . (string)$msg);
    }
}
