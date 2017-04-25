<?php
declare(strict_types=1);

namespace Zestic\User\Exception;

/**
 * Class InvalidName
 *
 * @package Zestic\User\Exception
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class InvalidName extends \InvalidArgumentException
{
    /**
     * @param string $msg
     * @return InvalidName
     */
    public static function reason($msg)
    {
        return new self('Invalid user name because ' . (string)$msg);
    }
}
