<?php

namespace StringOperations\UseCase;

class ReverseArrayAndItsValuesResponse
{
    /**
     * @var array
     */
    private $stringsReversed;

    public function __construct(array $stringsReversed)
    {
        $this->stringsReversed = $stringsReversed;
    }

    public function getStringsReversed()
    {
        return $this->stringsReversed;
    }
}
