<?php
declare(strict_types=1);

namespace Zestic\User\Repository;

use Zend\Expressive\Authentication\UserRepository\PdoDatabase;
use Zend\Expressive\Authentication\UserRepositoryInterface;

class UserRepository extends PdoDatabase implements UserRepositoryInterface
{
    public function createUser(array $data): int
    {

    }
}