<?php
declare(strict_types=1);

namespace Zestic\User\Transformer\Payload;

use Diaclone\Resource\ResourceInterface;
use Diaclone\Transformer\AbstractObjectTransformer;
use Zestic\User\Entity\Password;

class PayloadToPasswordTransformer extends AbstractObjectTransformer
{
    public function allowTransform(ResourceInterface $resource): bool
    {
        return false;
    }

    public function getObjectClass(): string
    {
        return Password::class;
    }

    public function untransform(ResourceInterface $resource)
    {
        $value = $resource->getData();

        return Password::fromString($value);
    }
}