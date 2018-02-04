<?php
declare(strict_types=1);

namespace Zestic\User\Transformer\Payload;

use Diaclone\Transformer\AbstractObjectTransformer;
use Zestic\User\Entity\User;

class PayloadToUserTransformer extends AbstractObjectTransformer
{
    protected static $mappedProperties = [
        'createdAt' => 'createdAt',
        'email'     => 'email',
        'identity'  => 'identity',
        'password'  => 'password',
        'updatedAt' => 'updatedAt',
    ];

    protected static $transformers = [
        'createdAt' => Iso8601ToMysqlTransformer::class,
        'password' => PayloadToPasswordTransformer::class,
        'updatedAt' => Iso8601ToMysqlTransformer::class,
    ];

    public function getObjectClass(): string
    {
        return User::class;
    }
}