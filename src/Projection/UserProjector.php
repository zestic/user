<?php
declare(strict_types=1);

namespace Zestic\User\Projection;

use Pac\ProophPackage\Projection\ReadModelProjectionInterface;
use Prooph\EventStore\Projection\ReadModelProjector;
use Zestic\User\Event\UserWasRegistered;

class UserProjector implements ReadModelProjectionInterface
{
    protected $handlers;
    protected $readModel;

    public function __construct()
    {
        $handlers = [

        ];
        $this->handlers = $handlers;
    }

    public function project(ReadModelProjector $projector): ReadModelProjector
    {
        $readModel = $projector->readModel();
        $projector
            ->fromStream('event_stream')
            ->when([
                UserWasRegistered::class => function ($state, $event) use ($readModel) {
                    UserRegisteredProjector::project($readModel, $state, $event);
                }
            ]);

        return $projector;
    }
}
