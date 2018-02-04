<?php
declare(strict_types=1);

namespace Tests\Unit\Transformer;

use Carbon\Carbon;
use DateTimeZone;
use Diaclone\Resource\ObjectItem;
use UnitTester;
use Zestic\User\Entity\Password;
use Zestic\User\Entity\User;
use Zestic\User\Interactor\VerifyPassword;
use Zestic\User\Transformer\Mysql\UserToMysqlTransformer;

class UserToMysqlTransformerCest
{
    public function testToMysql(UnitTester $I)
    {
        $user = (new User())
            ->setCreatedAt(new Carbon('2017-12-01T08:00:00.000Z'))
            ->setEmail('foo@bar.com')
            ->setIdentity('foo')
            ->setPassword(Password::fromString('password1'))
            ->setUpdatedAt(new Carbon('2017-12-01T08:00:00.000Z'));

        $resource = new ObjectItem($user);
        $result = (new UserToMysqlTransformer())->toArray($resource);

        $expected = [
            'created_at' => '2017-12-01 08:00:00',
            'email'      => 'foo@bar.com',
            'identity'   => 'foo',
            'password'   => $user->getPassword()->toString(),
            'updated_at' => '2017-12-01 08:00:00',
        ];

        $I->assertSame($expected, $result);
    }

    public function testToUser(UnitTester $I)
    {
        $data = [
            'created_at' => '2017-12-01 08:00:00',
            'email'      => 'foo@bar.com',
            'identity'   => 'foo',
            'password'   => Password::fromString('password1')->toString(),
            'updated_at' => '2017-12-01 08:00:00',
        ];

        $resource = new ObjectItem($data);
        /** @var User $user */
        $user = (new UserToMysqlTransformer())->toObject($resource);

        $carbon = new Carbon('2017-12-01 08:00:00', new DateTimeZone('UTC'));
        $I->assertEquals($carbon, $user->getCreatedAt());
        $I->assertSame('foo@bar.com', $user->getEmail());
        $I->assertSame('foo', $user->getIdentity());
        $I->assertTrue((new VerifyPassword)->handle('password1', $user->getPassword()));
        $I->assertEquals($carbon, $user->getUpdatedAt());

    }
}