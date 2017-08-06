<?php

namespace StringOperations\UseCase;

use StringOperations\Domain\Service\ReverseStringsService;

class ReverseArrayAndItsValuesUseCase
{
    private const NUMBER_OF_STRINGS_REQUIRED = 5;

    private $reverseStringsService;

    private $dataTransformer;

    public function __construct(
        ReverseStringsService $reverseStringsService,
        ReverseArrayAndItsValuesDataTransformer $dataTransformer
    ) {
        $this->reverseStringsService = $reverseStringsService;
        $this->dataTransformer = $dataTransformer;
    }

    public function execute(ReverseArrayAndItsValuesRequest $request)
    {
        $strings = $request->getStrings();

        $this->assertCorrectNumberOfStrings($strings);

        $stringsReversed = $this->reverseStringsService->execute($strings);

        return $this->dataTransformer->transform(
            new ReverseArrayAndItsValuesResponse(array_reverse($stringsReversed))
        );
    }

    private function assertCorrectNumberOfStrings(array $strings)
    {
        if (self::NUMBER_OF_STRINGS_REQUIRED !== count($strings)) {
            throw new \InvalidArgumentException('Invalid number of strings provided');
        }
    }
}
