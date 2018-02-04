<?php
declare(strict_types=1);

namespace Tests\Unit\Transformer;

use Diaclone\Resource\ObjectItem;
use UnitTester;
use Zestic\User\Entity\User;
use Zestic\User\Interactor\VerifyPassword;
use Zestic\User\Transformer\Payload\PayloadToUserTransformer;

class PayloadToUserTransformerCest
{
    public function testTransformToUser(UnitTester $I)
    {
        $incoming = [
            'email'     => 'foo@bar.com',
            'identity'  => 'foo',
            'password'  => 'password1',
        ];

        $resource = new ObjectItem($incoming);

        /** @var User $user */
        $user = (new PayloadToUserTransformer())->toObject($resource);

        $I->assertSame('foo@bar.com', $user->getEmail());
        $I->assertSame('foo', $user->getIdentity());
        $I->assertTrue((new VerifyPassword)->handle('password1', $user->getPassword()));
    }

    public function testTransformToPayload(UnitTester $I)
    {

        $expected = [
            'createdAt' => '2017-12-01 08:00:00',
            'email'      => 'foo@bar.com',
            'identity'   => 'foo',
            'updatedAt' => '2017-12-01 08:00:00',
        ];

    }
}