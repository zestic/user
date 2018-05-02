<?php
declare (strict_types=1);

namespace Zestic\User\GraphQL\Mutation;

use GraphQLMiddleware\Field\AbstractContainerAwareField;
use Respect\Validation\Validator;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Zestic\User\GraphQL\Type\InputObject\RegisterUserInput;
use Zestic\User\GraphQL\Type\Object\AuthorizationType;

class RegisterUser extends AbstractContainerAwareField
{
    public function build(FieldConfig $config)
    {
        $config->addArgument('input', new RegisterUserInput());
    }

    public function getName()
    {
        return 'registerUser';
    }

    public function getType()
    {
        return new AuthorizationType();
    }

    public function getValidationRules()
    {
        return [
            'input' => Validator::arrayType(),
        ];
    }
}
