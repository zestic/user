<?php

declare(strict_types=1);

namespace Zestic\User\Model\Factory;

use Psr\Container\ContainerInterface;
use Zestic\User\Model\Handler\RegisterUserHandler;
use Zestic\User\Model\Service\ChecksUniqueUsersEmailAddress;
use Zestic\User\Model\UserCollection;

class RegisterUserHandlerFactory
{
    public function __invoke(ContainerInterface $container): RegisterUserHandler
    {
        return new RegisterUserHandler(
            $container->get(UserCollection::class)
        );
    }
}
