<?php

namespace StringOperations\UseCase;

use Assert\Assertion;

class ReverseArrayAndItsValuesRequest
{
    /**
     * @var array
     */
    private $strings;

    public function __construct(array $strings)
    {
        $this->setStrings($strings);
    }

    public function getStrings()
    {
        return $this->strings;
    }

    private function setStrings(array $strings)
    {
        Assertion::allString($strings, 'Only strings accepted');
        $this->strings = $strings;
    }
}
