<?php

namespace Unit\StringOperations\Domain\Service;

use PHPUnit\Framework\TestCase;
use StringOperations\Domain\Service\ReverseStringsService;

class ReverseStringsServiceTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldReturnStringsRevertedAsExpected()
    {
        $strings = ['Lorem', 'isum', 'dolor', 'sit', 'amet'];
        $stringsReversed = ['meroL', 'musi', 'rolod', 'tis', 'tema'];

        $service = new ReverseStringsService();

        $this->assertSame($stringsReversed, $service->execute($strings));
    }
}

