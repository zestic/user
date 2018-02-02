<?php
declare(strict_types=1);

namespace Tests\Unit\GraphQL\Type\Domain;

use UnitTester;
use Zestic\User\GraphQL\Type\Domain\UserType;

class UserTypeCest
{
    /** @var UserType */
    protected $type;

    public function _before(UnitTester $I)
    {
        $this->type = new UserType();
    }

    public function testGetName(UnitTester $I)
    {
        $I->assertSame('User', $this->type->getName());
    }
}