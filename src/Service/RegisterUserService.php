<?php
declare(strict_types=1);

namespace Zestic\User\Service;


class RegisterUserService
{
    /** @var EventDispatcher */
    private $eventDispatcher;
    /** @var PersistCommuniqueRepo */
    private $persistUsers;
    public function __construct(PersistCommuniqueRepo $persistUsers, EventDispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->persistUsers = $persistUsers;
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
        $reply = $this->persistUsers($communique);
        $this->eventDispatcher->dispatch(UserEvent::POST_PROCESSING_REGISTER_USER, $event);
        return $reply;
    }

    private function createErrorResponseFromEvent(CommuniqueEvent $event): Reply
    {
    }

    private function persistUser(Communique $communique): Reply
    {
        return $this->persistUsers->handle($communique);
    }
}