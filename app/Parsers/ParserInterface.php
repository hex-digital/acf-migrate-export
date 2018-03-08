<?php

namespace App\Parsers;

interface ParserInterface
{
    /**
     * Take an array of data and return an output of some kind, such that the
     * input data has been processed to produce an expected output from it.
     *
     * @param array $data
     */
    public function parse(array $data);
}
