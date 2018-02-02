<?php
declare(strict_types=1);

namespace Tests\Unit\GraphQL;

use AspectMock\Test as Mock;
use Pac\ProophPackage\GraphQL\GraphQLMessageFactory;
use UnitTester;
use Zestic\User\GraphQL\Mutation\CreateUserMutation;

class CreateUserCest
{
    /** @var CreateUserMutation */
    protected $mutation;

    public function _before(UnitTester $I)
    {
        $mock = Mock::double(GraphQLMessageFactory::class, []);
        $factory = $mock->make();
        $this->mutation = new CreateUserMutation($factory);
    }

    public function testGetName(UnitTester $I)
    {
        $I->assertSame('createUser', $this->mutation->getName());
    }
}