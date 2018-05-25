<?php
declare(strict_types=1);

namespace Zestic\User\Entity;

use Ramsey\Uuid\Uuid;

class Person
{
    /** @var Uuid */
    private $id;

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function setId(Uuid $id): Person
    {
        $this->id = $id;

        return $this;
    }
}
