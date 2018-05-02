<?php
declare(strict_types=1);

namespace Zestic\User\Service;

use Common\Communique\Communique;
use Common\Communique\CommuniqueEvent;
use Common\Communique\Reply;
use Prooph\ServiceBus\CommandBus;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Zestic\User\Model\Command\RegisterUser;

class RegisterUserService
{
    /** @var CommandBus */
    private $commandBus;
    /** @var EventDispatcher */
    private $eventDispatcher;

    public function __construct(CommandBus $commandBus, EventDispatcher $eventDispatcher)
    {
        $this->commandBus = $commandBus;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function handle(Communique $communique): Reply
    {
        $event = new CommuniqueEvent($communique);
        $this->eventDispatcher->dispatch(UserEvent::PRE_PROCESSING_REGISTER_USER, $event);
        if ($event->isPropagationStopped()) {
            return $this->createErrorResponseFromEvent($event);
        }
        $this->eventDispatcher->dispatch(UserEvent::PROCESS_REGISTER_USER, $event);
        if ($event->isPropagationStopped()) {
            return $this->createErrorResponseFromEvent($event);
        }
        $command = RegisterUser::fromCommuique($communique);
        $reply = $this->commandBus->dispatch($communique);

        $this->eventDispatcher->dispatch(UserEvent::POST_PROCESSING_REGISTER_USER, $event);
        return $reply;
    }

    private function createErrorResponseFromEvent(CommuniqueEvent $event): Reply
    {
    }
}
