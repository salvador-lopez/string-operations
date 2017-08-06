<?php

namespace Tests\Unit\StringOperations\UseCase;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use StringOperations\Domain\Service\ReverseStringsService;
use StringOperations\UseCase\ReverseArrayAndItsValuesDataTransformer;
use StringOperations\UseCase\ReverseArrayAndItsValuesRequest;
use StringOperations\UseCase\ReverseArrayAndItsValuesResponse;
use StringOperations\UseCase\ReverseArrayAndItsValuesUseCase;

class ReverseArrayAndItsValuesUseCaseTest extends TestCase
{
    /**
     * @test
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid number of strings provided
     *
     * @dataProvider getInvalidNumberOfStringsDataProvider
     */
    public function itShouldThrowAnInvalidArgumentExceptionWhenTheNumberOfStringsIsNotFive(array $strings)
    {
        /** @var ReverseStringsService $reverseStringsService */
        $reverseStringsService = $this->buildReverseStringsServiceProphecy()->reveal();

        /** @var ReverseArrayAndItsValuesDataTransformer $dataTransformer */
        $dataTransformer = $this->buildReverseArrayAndItsValuesDataTransformerProphecy()->reveal();

        $useCase = $this->buildUseCase($reverseStringsService, $dataTransformer);

        $request = $this->buildUseCaseRequest($strings);

        $useCase->execute($request);
    }

    public function getInvalidNumberOfStringsDataProvider(): array
    {
        return [
            'Six strings' => [['Lorem', 'isum', 'dolor', 'sit', 'amet', 'dolor']],
            'Four strings' => [['Lorem', 'isum', 'dolor', 'sit']],
        ];
    }

    /**
     * @test
     */
    public function itShouldReturnStringResultingOfReverseAndImplodeStringsFromRequest()
    {
        $strings = ['Lorem', 'isum', 'dolor', 'sit', 'amet'];
        $stringsReversed = ['meroL', 'musi', 'rolod', 'tis', 'tema'];
        $responseExpected = new ReverseArrayAndItsValuesResponse(['tema', 'tis', 'rolod', 'musi', 'meroL']);
        $transformedResponseExpected = 'tema tis rolod musi meroL';

        $reverseStringsService = $this->buildReverseStringsService($strings, $stringsReversed);
        $dataTransformer = $this->buildReverseArrayAndItsValuesDataTransformer(
            $responseExpected,
            $transformedResponseExpected
        );

        $useCase = $this->buildUseCase($reverseStringsService, $dataTransformer);

        $request = $this->buildUseCaseRequest($strings);

        $this->assertSame($transformedResponseExpected, $useCase->execute($request));
    }

    private function buildUseCase(
        ReverseStringsService $reverseStringsService,
        ReverseArrayAndItsValuesDataTransformer $dataTransformer
    ): ReverseArrayAndItsValuesUseCase
    {
        return new ReverseArrayAndItsValuesUseCase($reverseStringsService, $dataTransformer);
    }

    private function buildUseCaseRequest(array $strings): ReverseArrayAndItsValuesRequest
    {
        return new ReverseArrayAndItsValuesRequest($strings);
    }

    private function buildReverseStringsServiceProphecy(): ObjectProphecy
    {
        return $this->prophesize(ReverseStringsService::class);
    }

    private function buildReverseStringsService(array $strings, array $stringsReversed): ReverseStringsService
    {
        $serviceProphecy = $this->buildReverseStringsServiceProphecy();
        $serviceProphecy->execute($strings)->willReturn($stringsReversed);

        return $serviceProphecy->reveal();
    }

    private function buildReverseArrayAndItsValuesDataTransformerProphecy(): ObjectProphecy
    {
        return $this->prophesize(ReverseArrayAndItsValuesDataTransformer::class);
    }

    private function buildReverseArrayAndItsValuesDataTransformer(
        ReverseArrayAndItsValuesResponse $responseExpected,
        string $transformedResponseExpected
    ): ReverseArrayAndItsValuesDataTransformer
    {
        $dataTransformerProphecy = $this->buildReverseArrayAndItsValuesDataTransformerProphecy();
        $dataTransformerProphecy
            ->transform(Argument::exact($responseExpected))
            ->willReturn($transformedResponseExpected);

        return $dataTransformerProphecy->reveal();
    }
}

