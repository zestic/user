<?php
declare (strict_types=1);

namespace Zestic\User\GraphQL\Mutation;

use Pac\ProophPackage\GraphQL\ProophBridgeField;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;

class CreateUserMutation extends ProophBridgeField
{
    public function build(FieldConfig $config)
    {
    }

    public function getName()
    {
        return 'createUser';
    }

    public function getType()
    {
        // TODO: Implement getType() method.
    }

    protected function resolveData($value, array $args, ResolveInfo $info): array
    {
        // TODO: Implement resolveData() method.
    }
}
