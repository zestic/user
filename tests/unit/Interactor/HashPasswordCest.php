<?php
declare(strict_types=1);

namespace Tests\Unit\Interactor;

use UnitTester;
use Zestic\User\Interactor\HashPassword;
use Zestic\User\Interactor\VerifyPassword;

class HashPasswordCest
{
    public function testHandle(UnitTester $I)
    {
        $password = 'password1';
        $hashed = (new HashPassword())->handle($password);

        $I->assertTrue(password_verify($password, $hashed));
    }
}