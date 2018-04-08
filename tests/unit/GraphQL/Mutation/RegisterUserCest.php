<?php
declare(strict_types=1);

namespace Tests\Unit\GraphQL\Mutation;

use AspectMock\Test as Mock;
use Pac\ProophPackage\GraphQL\GraphQLMessageFactory;
use UnitTester;
use Zestic\User\GraphQL\Mutation\RegisterUser;

class RegisterUserCest
{
    /** @var RegisterUser */
    protected $mutation;

    public function _before(UnitTester $I)
    {
        $mock = Mock::double(GraphQLMessageFactory::class, []);
        $factory = $mock->make();
        $this->mutation = new RegisterUser($factory);
    }

    public function testGetName(UnitTester $I)
    {
        $I->assertSame('registerUser', $this->mutation->getName());
    }
}