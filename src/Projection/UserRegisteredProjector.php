<?php
declare(strict_types=1);

namespace Zestic\User\Projection;

use Zestic\User\Event\UserWasRegistered;

class UserRegisteredProjector
{
    public static function project($readModel, $state, UserWasRegistered $event)
    {
        $readModel->stack(
            'insert',
            [
                'credentials_expired' => (int) $event->isCredentialsExpired(),
                'email'               => $event->emailAddress()->toString(),
                'email_canonical'     => $event->emailAddress()->canonicalized(),
                'enabled'             => (int) $event->isEnabled(),
                'expired'             => (int) $event->isExpired(),
                'id'                  => $event->userId()->getBytes(),
                'locked'              => (int) $event->isLocked(),
                'password'            => $event->password(),
                'roles'               => json_encode($event->roles()),
                'username'            => $event->username()->toString(),
                'username_canonical'  => $event->username()->canonicalized(),
            ]
        );
    }
}
