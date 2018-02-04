<?php
declare(strict_types=1);

namespace Tests\Unit\Interactor;

use UnitTester;
use Zestic\User\Entity\Password;
use Zestic\User\Interactor\VerifyPassword;

class VerifyPasswordCest
{
    public function testVerifiedHandle(UnitTester $I)
    {
        $attempt = 'password1';
        $password = Password::fromString($attempt);

        $I->assertTrue((new VerifyPassword())->handle($attempt, $password));
    }

    public function testUnverifiedHandle(UnitTester $I)
    {
        $password = Password::fromString('password1');

        $I->assertFalse((new VerifyPassword())->handle('password2', $password));
    }
}