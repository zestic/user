<?php
declare(strict_types=1);

namespace Zestic\User\Transformer\Mysql;

use Diaclone\Transformer\AbstractObjectTransformer;
use Zestic\User\Entity\User;

class UserToMysqlTransformer extends AbstractObjectTransformer
{
    protected static $mappedProperties = [
        'createdAt' => 'created_at',
        'email'     => 'email',
        'identity'  => 'identity',
        'password'  => 'password',
        'updatedAt' => 'updated_at',
    ];

    protected static $transformers = [
        'createdAt' => CarbonToMysqlTransformer::class,
        'password'   => PasswordToMysqlTransformer::class,
        'updatedAt' => CarbonToMysqlTransformer::class,
    ];

    public function getObjectClass(): string
    {
        return User::class;
    }
}