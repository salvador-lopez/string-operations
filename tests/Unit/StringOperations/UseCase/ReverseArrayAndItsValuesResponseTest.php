<?php

namespace Unit\StringOperations\UseCase;

use PHPUnit\Framework\TestCase;
use StringOperations\UseCase\ReverseArrayAndItsValuesResponse;

class ReverseArrayAndItsValuesResponseTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldBuildTheResponseAsExpected()
    {
        $stringsReversed = ['gnirts', 'string rehtona'];

        $this->assertSame($stringsReversed, $this->buildResponse($stringsReversed)->getStringsReversed());
    }

    private function buildResponse(array $stringsReversed): ReverseArrayAndItsValuesResponse
    {
        return new ReverseArrayAndItsValuesResponse($stringsReversed);
    }
}

