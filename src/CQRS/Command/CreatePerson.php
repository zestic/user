<?php
declare(strict_types=1);

namespace Zestic\User\CQRS\Command;

use Common\Communique\CommuniqueConstructableInterface;
use Common\Communique\CommuniqueConstructableTrait;
use Prooph\Common\Messaging\Command;

final class CreatePerson extends Command implements CommuniqueConstructableInterface
{
    use CommuniqueConstructableTrait;

}
