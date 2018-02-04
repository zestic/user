<?php
declare(strict_types=1);

namespace Zestic\User\Transformer\Mysql;

use Carbon\Carbon;
use DateTimeZone;
use Diaclone\Exception\TransformException;
use Diaclone\Resource\ResourceInterface;
use Diaclone\Transformer\AbstractTransformer;
use Exception;

class CarbonToMysqlTransformer extends AbstractTransformer
{
    public function transform(ResourceInterface $resource)
    {
        $value = $this->getPropertyValueFromResource($resource);
        if (empty($value)) {
            return '';
        }

        try {
            return (new Carbon($value, new DateTimeZone('UTC')))->toDateTimeString();
        } catch (Exception $e) {
            throw new TransformException('Failed to transform ' . $resource->getPropertyName() . ' because Carbon.');
        }
    }

    public function untransform(ResourceInterface $resource)
    {
        $value = $resource->getData();
        if (empty($value)) {
            return null;
        }

        try {
            return new Carbon($value, new DateTimeZone('UTC'));
        } catch (Exception $e) {
            throw new TransformException('Failed to transform ' . $resource->getPropertyName() . ' because Carbon.');
        }

    }
}