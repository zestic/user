<?php
declare(strict_types=1);

namespace Zestic\User\Factory;

use Prooph\ServiceBus\CommandBus;
use Psr\Container\ContainerInterface;
use Zestic\User\Service\RegisterUserService;

class RegisterUserServiceFactory
{
    public function __invoke(ContainerInterface $container): RegisterUserService
    {
        $commandBus = $container->get(CommandBus::class);
        $eventDispatcher = $container->get('eventDispatcher');

        return new RegisterUserService($commandBus, $eventDispatcher);
    }
}
