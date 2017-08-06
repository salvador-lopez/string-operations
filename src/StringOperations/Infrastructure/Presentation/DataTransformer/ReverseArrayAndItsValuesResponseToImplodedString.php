<?php

namespace StringOperations\Infrastructure\Presentation\DataTransformer;

use StringOperations\UseCase\ReverseArrayAndItsValuesDataTransformer;
use StringOperations\UseCase\ReverseArrayAndItsValuesResponse;

class ReverseArrayAndItsValuesResponseToImplodedString implements ReverseArrayAndItsValuesDataTransformer
{
    public function transform(ReverseArrayAndItsValuesResponse $response)
    {
        return implode(' ', $response->getStringsReversed());
    }
}
