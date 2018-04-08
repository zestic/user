<?php
declare(strict_types=1);

namespace Zestic\User\GraphQL\Type\Object;

use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Type\Scalar\StringType;

class AuthorizationType extends AbstractObjectType
{
    /**
     * @param ObjectTypeConfig $config
     */
    public function build($config)
    {
        $config
            ->addField('token', new StringType());
    }
}