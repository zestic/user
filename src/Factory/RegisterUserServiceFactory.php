<?php
declare(strict_types=1);

namespace Zestic\User\Factory;

use Psr\Container\ContainerInterface;
use Zestic\User\Service\RegisterUserService;

class RegisterUserServiceFactory
{
    public function __invoke(ContainerInterface $container): RegisterUserService
    {
        $eventDispatcher = $container->get('eventDispatcher');

        return new RegisterUserService($eventDispatcher);
    }
}
