<?php
declare(strict_types=1);

namespace Zestic\User\Interactor;

use Common\Communique\CommunicationEvent;
use Zestic\User\Model\Command\RegisterUser;

final class RegisterUserCommand
{
    /** @var CommandBus */
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function handle(CommunicationEvent $event)
    {
        $communique = $event->getCommunique();
        $command = RegisterUser::fromCommunique($communique);
        $this->commandBus->dispatch($command);
    }
}