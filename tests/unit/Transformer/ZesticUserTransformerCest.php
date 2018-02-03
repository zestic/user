<?php
declare(strict_types=1);

namespace Tests\Unit\Transformer;

use Diaclone\Resource\Item;
use UnitTester;
use Zestic\User\Transformer\ZesticUserTransformer;

class ZesticUserTransformerCest
{
    public function testUntransformToMysql(UnitTester $I)
    {
        $incoming = [
            'createdAt' => '2017-12-01T08:00:00.000Z',
            'email'     => 'foo@bar.com',
            'identity'  => 'foo',
            'password'  => '$argon2i$v=19$m=1024,t=2,p=2$SnE0YW4uejFvRTF2S3FQWQ$KLiHtVHIGAG7DP99/08wjjfTBMB9VqJaQuAm/uuVV8k',
            'updatedAt' => '2017-12-01T08:00:00.000Z',
        ];

        $expected = [
            'created_at' => '2017-12-01 08:00:00',
            'email'      => 'foo@bar.com',
            'identity'   => 'foo',
            'password'   => '$argon2i$v=19$m=1024,t=2,p=2$SnE0YW4uejFvRTF2S3FQWQ$KLiHtVHIGAG7DP99/08wjjfTBMB9VqJaQuAm/uuVV8k',
            'updated_at' => '2017-12-01 08:00:00',
        ];

        $resource = new Item($incoming);
        $result = (new ZesticUserTransformer())->untransform($resource);

        $I->assertSame($expected, $result);
    }
}