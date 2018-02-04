<?php
declare(strict_types=1);

namespace Tests\Unit\Transformer;

use Diaclone\Resource\ObjectItem;
use UnitTester;
use Zestic\User\Entity\Password;
use Zestic\User\Transformer\Mysql\PasswordToMysqlTransformer;

class PasswordToMysqlTransformerCest
{
    public function testToPassword(UnitTester $I)
    {
        $hashedPassword = '$argon2i$v=19$m=1024,t=2,p=2$SnE0YW4uejFvRTF2S3FQWQ$KLiHtVHIGAG7DP99/08wjjfTBMB9VqJaQuAm/uuVV8k';
        $resource = new ObjectItem($hashedPassword);

        /** @var Password $password */
        $password = (new PasswordToMysqlTransformer())->toObject($resource);

        $I->assertInstanceOf(Password::class, $password);
        $I->assertSame($hashedPassword, $password->toString());
    }

    public function testToMysql(UnitTester $I)
    {
        $password = Password::fromString('password1');
        $resource = new ObjectItem($password);

        /** @var Password $password */
        $value = (new PasswordToMysqlTransformer())->toArray($resource);

        $I->assertSame($password->toString(), $value);
    }
}