<?php
declare(strict_types=1);

namespace Zestic\User\Handler;

use Zestic\User\Command\RegisterUserCommand;
use Zestic\User\Repository\EventStore\UserCollection;
use Zestic\User\User;

final class RegisterUserHandler
{
    /**
     * @var UserCollection
     */
    private $userCollection;

    /**
     * @param UserCollection $userCollection
     */
    public function __construct(UserCollection $userCollection)
    {
        $this->userCollection = $userCollection;
    }

    /**
     * @param RegisterUserCommand $command
     */
    public function __invoke(RegisterUserCommand $command)
    {
        $user = User::registerWithData($command->userId(), $command->emailAddress(), $command->password(), $command->username());

        $this->userCollection->add($user);
    }
}
