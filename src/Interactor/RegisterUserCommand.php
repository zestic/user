<?php
declare(strict_types=1);

namespace Zestic\User\Interactor;

use Common\Communique\CommunicationEvent;
use Zestic\User\CQRS\Aggregate\User;
use Zestic\User\CQRS\Event\UserWasRegistered;
use Zestic\User\CQRS\EventStore\Repository\UserEventStore;

final class RegisterUserCommand
{
    /** @var UserEventStore */
    private $eventStore;

    public function __construct(UserEventStore $eventStore)
    {
        $this->eventStore = $eventStore;
    }

    public function __invoke(CommunicationEvent $event)
    {
        $communique = $event->getCommunique();

        $event = UserWasRegistered::fromCommunique($communique);

//        $aggregateId = '8b317c28c2084d659cd77800fcdae7ad';
//        $user = $this->eventStore->get($aggregateId);
//        $user->recordEvent($event);

        $user = User::createFromCommunique($communique);
        $user->recordEvent($event);

        $this->eventStore->save($user);
    }
}
