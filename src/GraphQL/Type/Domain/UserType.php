<?php
declare(strict_types=1);

namespace Zestic\User\GraphQL\Type\Domain;

use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Type\Scalar\StringType;

class UserType extends AbstractObjectType
{
    /**
     * @param ObjectTypeConfig $config
     */
    public function build($config)
    {
        $config
            ->addFields(
                [
                    'email'    => new StringType(),
                    'id'       => new UuidType(),
                    'password' => new StringType(),
                    'username' => new StringType(),
                ]
            );
    }

    public function getName()
    {
        return 'User';
    }
}