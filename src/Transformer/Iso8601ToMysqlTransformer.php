<?php
declare(strict_types=1);

namespace Zestic\User\Transformer;

use Carbon\Carbon;
use DateTimeZone;
use Diaclone\Exception\TransformException;
use Diaclone\Resource\ResourceInterface;
use Diaclone\Transformer\AbstractTransformer;
use Exception;

class Iso8601ToMysqlTransformer extends AbstractTransformer
{
    public function transform(ResourceInterface $resource)
    {
        $value = $this->getPropertyValueFromResource($resource);
        if (empty($value)) {
            return '';
        }

        try {
            $carbon = new Carbon($value, new DateTimeZone('UTC'));
                // replace '+##:##' with '+####'
            return preg_replace_callback('/\+[0-9]{2}:[0-9]{2}/', function($matches) {
                return str_replace(':', '', $matches[0]);
            }, $carbon->toIso8601String());

        } catch (Exception $e) {
            throw new TransformException('Failed to transform ' . $resource->getPropertyName() . ' because Carbon.');
        }
    }

    public function untransform(ResourceInterface $resource)
    {
        $value = $this->getPropertyValueFromResource($resource);
        if (empty($value)) {
            return '';
        }

        try {
            return (new Carbon($value, new DateTimeZone('UTC')))->toDateTimeString();
                // replace '+##:##' with '+####'
            return preg_replace_callback('/\+[0-9]{2}:[0-9]{2}/', function($matches) {
                return str_replace(':', '', $matches[0]);
            }, $carbon->toIso8601String());

        } catch (Exception $e) {
            throw new TransformException('Failed to transform ' . $resource->getPropertyName() . ' because Carbon.');
        }
    }
}