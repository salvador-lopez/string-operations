<?php

namespace StringOperations\Domain\Service;

class ReverseStringsService
{
    public function execute(array $strings)
    {
        foreach ($strings as &$string) {
            $string = strrev($string);
        }

        return $strings;
    }
}
