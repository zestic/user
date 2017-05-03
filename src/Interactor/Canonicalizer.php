<?php
declare(strict_types=1);

namespace Zestic\User\Interactor;

/**
 * From FOSUserBundle
 */
class Canonicalizer
{
    public static function canonicalize($string)
    {
        if (null === $string) {
            return null;
        }
        $encoding = mb_detect_encoding($string);
        $result = $encoding
            ? mb_convert_case($string, MB_CASE_LOWER, $encoding)
            : mb_convert_case($string, MB_CASE_LOWER);
        return $result;
    }
}
