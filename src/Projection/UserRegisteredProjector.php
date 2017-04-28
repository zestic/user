<?php
declare(strict_types=1);

namespace Zestic\User\Projection;

use Zestic\User\Event\UserWasRegistered;

class UserRegisteredProjector
{
    public function __invoke($state, UserWasRegistered $event)
    {
        $this->readModel()->stack('insert', [
            'id' => $event->userId()->toString(),
            'name' => $event->name()->toString(),
            'email' => $event->emailAddress()->toString(),
        ]);
    }
}
