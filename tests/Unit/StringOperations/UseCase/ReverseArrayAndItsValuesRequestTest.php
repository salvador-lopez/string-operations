<?php

namespace Unit\StringOperations\UseCase;

use PHPUnit\Framework\TestCase;
use StringOperations\UseCase\ReverseArrayAndItsValuesRequest;

class ReverseArrayAndItsValuesRequestTest extends TestCase
{
    /**
     * @test
     *
     * @expectedException \InvalidArgumentException
     */
    public function itShouldThrowAnInvalidArgumentExceptionWhenArrayNotContainOnlyStrings()
    {
        $strings = ['string', 10, 'another string'];

        $this->buildRequest($strings);
    }

    /**
     * @test
     */
    public function itShouldBuildTheRequestWhenArrayContainOnlyStrings()
    {
        $strings = ['string', 'another string'];

        $this->assertSame($strings, $this->buildRequest($strings)->getStrings());
    }

    private function buildRequest(array $strings): ReverseArrayAndItsValuesRequest
    {
        return new ReverseArrayAndItsValuesRequest($strings);
    }
}

