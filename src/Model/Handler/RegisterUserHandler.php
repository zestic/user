<?php
/**
 * This file is part of prooph/proophessor-do.
 * (c) 2014-2018 prooph software GmbH <contact@prooph.de>
 * (c) 2015-2018 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Zestic\User\Model\Handler;

use Zestic\User\Model\Command\RegisterUser;
use Zestic\User\Model\Exception\UserAlreadyExists;
use Zestic\User\Model\Exception\UserNotFound;
use Zestic\User\Model\Service\ChecksUniqueUsersEmailAddress;
use Zestic\User\Model\User;
use Zestic\User\Model\UserCollection;

class RegisterUserHandler
{
    /**
     * @var UserCollection
     */
    private $userCollection;

    /**
     * @var ChecksUniqueUsersEmailAddress
     */
    private $checksUniqueUsersEmailAddress;

    public function __construct(
        UserCollection $userCollection,
        ChecksUniqueUsersEmailAddress $checksUniqueUsersEmailAddress
    ) {
        $this->userCollection = $userCollection;
        $this->checksUniqueUsersEmailAddress = $checksUniqueUsersEmailAddress;
    }

    public function __invoke(RegisterUser $command): void
    {
        if ($userId = ($this->checksUniqueUsersEmailAddress)($command->emailAddress())) {
            if (! $user = $this->userCollection->get($userId)) {
                throw UserNotFound::withUserId($userId);
            }

            $user->registerAgain($command->name());
        } else {
            if ($user = $this->userCollection->get($command->userId())) {
                throw UserAlreadyExists::withUserId($command->userId());
            }
            $user = User::registerWithData($command->userId(), $command->name(), $command->emailAddress());
        }

        $this->userCollection->save($user);
    }
}
