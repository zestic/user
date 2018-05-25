<?php

declare(strict_types=1);

namespace Zestic\User\CQRS\Handler;

use Zestic\User\CQRS\Command\RegisterUser;
use Zestic\User\CQRS\Exception\UserAlreadyExists;
use Zestic\User\CQRS\Exception\UserNotFound;
use Zestic\User\CQRS\Service\ChecksUniqueUsersEmailAddress;
use Zestic\User\CQRS\Aggregate\User;
use Zestic\User\CQRS\Aggregate\UserCollection;

class RegisterUserHandler
{
    /** @var UserCollection */
    private $userCollection;

    /**
     * @var ChecksUniqueUsersEmailAddress
     */
    private $checksUniqueUsersEmailAddress;

    public function __construct(
        UserCollection $userCollection
    ) {
        $this->userCollection = $userCollection;
//        $this->checksUniqueUsersEmailAddress = $checksUniqueUsersEmailAddress;
    }

    public function __invoke(RegisterUser $command): void
    {
//        if ($userId = ($this->checksUniqueUsersEmailAddress)($command->emailAddress())) {
//            if (! $user = $this->userCollection->get($userId)) {
//                throw UserNotFound::withUserId($userId);
//            }
//
//            $user->registerAgain($command->name());
//        } else {
//            if ($user = $this->userCollection->get($command->userId())) {
//                throw UserAlreadyExists::withUserId($command->userId());
//            }
//            $user = User::registerWithData($command->userId(), $command->name(), $command->emailAddress());
//        }
        $user = User::registerWithData($command->userId(), $command->name(), $command->emailAddress());
      //  $user = User::registerFromCommand($command);

        $this->userCollection->save($user);
    }
}
