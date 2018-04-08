<?php
declare (strict_types=1);

namespace Zestic\User\GraphQL\Mutation;

use GraphQLMiddleware\Field\AbstractContainerAwareField;
use Respect\Validation\Validator;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Zestic\User\GraphQL\Type\InputObject\RegisterUserInput;
use Zestic\User\GraphQL\Type\Object\AuthorizationType;

class RegisterUser extends AbstractContainerAwareField
{
    public function build(FieldConfig $config)
    {
        $config->addArgument('input', new RegisterUserInput());
    }

    public function resolve($value, array $args, ResolveInfo $info)
    {
        // $service = $this->getContainer()->get(TodoService::class);
        return ['token' => '8675309'];
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
