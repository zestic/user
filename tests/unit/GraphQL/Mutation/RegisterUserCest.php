<?php
declare(strict_types=1);

namespace Tests\Unit\GraphQL\Mutation;

use AspectMock\Test as Mock;
use Pac\ProophPackage\GraphQL\GraphQLMessageFactory;
use UnitTester;
use Zestic\User\GraphQL\Mutation\RegisterUserMutation;

class RegisterUserCest
{
    /** @var RegisterUserMutation */
    protected $mutation;

    public function _before(UnitTester $I)
    {
        $mock = Mock::double(GraphQLMessageFactory::class, []);
        $factory = $mock->make();
        $this->mutation = new RegisterUserMutation($factory);
    }

    public function testGetName(UnitTester $I)
    {
        $I->assertSame('registerUser', $this->mutation->getName());
    }
}