<?php
declare(strict_types=1);

namespace Zestic\User\Interactor;

use Zend\Expressive\Authentication\UserRepositoryInterface;

final class RegisterUser
{
    /** @var UserRepositoryInterface */
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(array $data)
    {

    }
}