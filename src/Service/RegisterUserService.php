<?php
declare(strict_types=1);

namespace Zestic\User\Service;

use Common\Communique\CommunicationEvent;
use Common\Communique\Communique;
use Common\Communique\CommuniqueEvent;
use Common\Communique\Reply;
use Common\Communique\ServiceHandlerInterface;
use Prooph\ServiceBus\CommandBus;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Zestic\User\Model\Command\RegisterUser;

class RegisterUserService implements ServiceHandlerInterface
{
    /** @var EventDispatcher */
    private $eventDispatcher;

    public function __construct(EventDispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function handle(Communique $communique): Reply
    {
        $event = new CommunicationEvent($communique);

        $this->eventDispatcher->dispatch(__CLASS__ . '.pre', $event);
        if ($event->isPropagationStopped()) {
            return $event->getErrorReply();
        }
        $this->eventDispatcher->dispatch(__CLASS__ . '.process', $event);
        if ($event->isPropagationStopped()) {
            return $event->getErrorReply();
        }

        $this->eventDispatcher->dispatch(__CLASS__ . '.post', $event);
        if ($event->isPropagationStopped()) {
            return $event->getErrorReply();
        }

        return $event->getReply();
    }
}
