<?php
declare(strict_types=1);

namespace Tests\Unit\Transformer;

use Diaclone\Resource\Item;
use UnitTester;
use Zestic\User\Transformer\Iso8601ToMysqlTransformer;

class Iso8601ToMysqlTransformerCest
{
    public function testTransfom(UnitTester $I)
    {
        $resource = new Item('2016-09-21 08:53:00');

        $isoDateTime = (new Iso8601ToMysqlTransformer())->transform($resource);

        $I->assertSame('2016-09-21T08:53:00+0000', $isoDateTime);
    }

    public function testUntransform(UnitTester $I)
    {
        $resource = new Item('2016-01-12T17:00:00Z');
        $mySqlDateTime = (new Iso8601ToMysqlTransformer())->untransform($resource);

        $I->assertEquals('2016-01-12 17:00:00', $mySqlDateTime);
    }
}