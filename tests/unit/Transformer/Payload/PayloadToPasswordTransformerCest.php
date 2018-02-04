<?php
declare(strict_types=1);

namespace Tests\Unit\Transformer;

use Diaclone\Resource\ObjectItem;
use UnitTester;
use Zestic\User\Entity\Password;
use Zestic\User\Entity\User;
use Zestic\User\Interactor\VerifyPassword;
use Zestic\User\Transformer\Payload\PayloadToPasswordTransformer;

class PayloadToPasswordTransformerCest
{
    public function testTransformInUser(UnitTester $I)
    {
        $user = (new User())
            ->setPassword(Password::fromString('password1'));

        $resource = new ObjectItem($user);
        $data = (new PayloadToPasswordTransformer())->transform($resource);

        $I->assertArrayNotHasKey('password', $data);
    }

    public function testUntransform(UnitTester $I)
    {
        $resources = new ObjectItem('password1');

        $password = (new PayloadToPasswordTransformer())->untransform($resources);

        $I->assertTrue((new VerifyPassword())->handle('password1', $password));
    }
}