<?php
declare(strict_types=1);

namespace Zestic\User\Service;

class LogInUser
{
    /** @var RepositoryInterface */
    private $personRepo;

    public function __construct(ReadRepository $personRepo)
    {
        $this->personRepo = $personRepo;
    }

    public function handle()
    {
        /** @var $user */
        $personId = $user->getPersonId();
    }
}
