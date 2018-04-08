<?php
declare(strict_types=1);

namespace Zestic\User\GraphQL\Type\InputObject;

use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\InputObject\AbstractInputObjectType;
use Youshido\GraphQL\Type\Scalar\StringType;

class RegisterUserInput extends AbstractInputObjectType
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
                    'id'       => new StringType(),
                    'password' => new StringType(),
                    'username' => new StringType(),
                ]
            );
    }

    public function getName()
    {
        return 'RegisterUserInput';
    }
}