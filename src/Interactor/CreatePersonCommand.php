<?php
declare(strict_types=1);

namespace Zestic\User\Interactor;

use Common\Communique\CommunicationEvent;
use Prooph\ServiceBus\CommandBus;

class CreatePersonCommand
{
    /** @var CommandBus */
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(CommunicationEvent $event)
    {
        $communique = $event->getCommunique();
        $command = CreatePerson::fromCommunique($communique);
        $this->commandBus->dispatch($command);
    }

}
