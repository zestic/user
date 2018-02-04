<?php
declare(strict_types=1);

namespace Tests\Unit\Transformer;

use Carbon\Carbon;
use DateTimeZone;
use Diaclone\Resource\Item;
use UnitTester;
use Zestic\User\Transformer\Mysql\CarbonToMysqlTransformer;

class CarbonToMysqlTransformerCest
{
    public function testTransform(UnitTester $I)
    {
        $resource = new Item(new Carbon('2016-01-12T17:00:00Z', new DateTimeZone('UTC')));
        $mySqlDateTime = (new CarbonToMysqlTransformer())->transform($resource);

        $I->assertSame('2016-01-12 17:00:00', $mySqlDateTime);
    }

    public function testUntransfom(UnitTester $I)
    {
        $time = '2016-09-21 08:53:00';
        $resource = new Item($time);

        $carbon = (new CarbonToMysqlTransformer())->untransform($resource);

        $I->assertEquals(new Carbon($time, new DateTimeZone('UTC')), $carbon);
    }
}