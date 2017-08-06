<?php

namespace Unit\StringOperations\Infrastructure\Presentation\DataTransformer;

use PHPUnit\Framework\TestCase;
use StringOperations\Infrastructure\Presentation\DataTransformer\ReverseArrayAndItsValuesResponseToImplodedString;
use StringOperations\UseCase\ReverseArrayAndItsValuesResponse;

class ReverseArrayAndItsValuesResponseToImplodedStringTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldTransformResponseAsExpected()
    {
        $stringsReversed = ['gnirts', 'string rehtona'];
        $response = new ReverseArrayAndItsValuesResponse($stringsReversed);
        $responseTransformed = 'gnirts string rehtona';

        $dataTransformer = new ReverseArrayAndItsValuesResponseToImplodedString();

        $this->assertSame($responseTransformed, $dataTransformer->transform($response));
    }
}

