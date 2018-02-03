<?php
declare(strict_types=1);

namespace Zestic\User\Transformer;

use Diaclone\Transformer\AbstractTransformer;

class ZesticUserTransformer extends AbstractTransformer
{
    protected static $mappedProperties = [
        'created_at' => 'createdAt',
        'email'      => 'email',
        'identity'   => 'identity',
        'password'   => 'password',
        'updated_at' => 'updatedAt',
    ];

    protected static $transformers = [
        'created_at' => Iso8601ToMysqlTransformer::class,
        'updated_at' => Iso8601ToMysqlTransformer::class,
    ];

}