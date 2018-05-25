<?php

declare(strict_types=1);

namespace Zestic\User\CQRS\Factory;

use Psr\Container\ContainerInterface;
use Zestic\User\CQRS\Aggregate\UserCollection;
use Zestic\User\CQRS\Handler\RegisterUserHandler;

class RegisterUserHandlerFactory
{
    public function __invoke(ContainerInterface $container): RegisterUserHandler
    {
        return new RegisterUserHandler(
            $container->get(UserCollection::class)
        );
    }
}
