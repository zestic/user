<?php
declare(strict_types=1);

namespace Zestic\User\Transformer\Mysql;

use Closure;
use Diaclone\Resource\ResourceInterface;
use Diaclone\Transformer\AbstractObjectTransformer;
use ReflectionClass;
use Zestic\User\Entity\Password;

class PasswordToMysqlTransformer extends AbstractObjectTransformer
{
    public function getObjectClass(): string
    {
        return Password::class;
    }

    public function transform(ResourceInterface $resource)
    {
        $value = $this->getPropertyValueFromResource($resource);

        return $value->toString();
    }

    public function untransform(ResourceInterface $resource)
    {
        $value = $resource->getData();

        $setProperty = function($password, $value) {
            $closure = function () use ($value) {
                $this->password = $value;
            };
            Closure::bind($closure, $password, Password::class)->__invoke();
        };

        $rc = new ReflectionClass(Password::class);
        $password = $rc->newInstanceWithoutConstructor();
        $setProperty($password, $value);

        return $password;
    }
}