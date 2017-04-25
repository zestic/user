<?php
declare(strict_types=1);

namespace Zestic\User\Handler;

use Zestic\User\Command\RegisterUser;
use Zestic\User\User;
use Zestic\User\UserCollection;

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
     * @param RegisterUser $command
     */
    public function __invoke(RegisterUser $command)
    {
        $user = User::registerWithData($command->userId(), $command->name(), $command->emailAddress());

        $this->userCollection->add($user);
    }
}
