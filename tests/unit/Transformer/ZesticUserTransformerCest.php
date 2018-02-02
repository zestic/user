<?php
declare(strict_types=1);

namespace Tests\Unit\Transformer;

use Diaclone\Resource\Item;
use UnitTester;
use Zestic\User\Transformer\ZesticUserTransformer;

class ZesticUserTransformerCest
{
    public function testUntransform(UnitTester $I)
    {
        $incoming = [
            'createdAt' => '2018-01-01 08:00:00',
            'email' => 'foo@bar.com',
            'identity' => 'foo',
            'password' => 'password1',
            'updatedAt' => '2018-01-01 08:00:00',
        ];

        $expected = [
            'created_at' => '2018-01-01 08:00:00',
            'email' => 'foo@bar.com',
            'identity' => 'foo',
            'password' => 'password1',
            'updated_at' => '2018-01-01 08:00:00',
        ];

        $resource = new Item($incoming);
        $result = (new ZesticUserTransformer())->untransform($resource);

        $I->assertSame($expected, $result);
    }
}