<?php

namespace ApiRest\Application\Query\Show;

class ShowResponse
{

    private array $result;

    public function __construct(array $array)
    {
        $this->result = $array;
    }

    public function result(): array
    {
        return $this->result;
    }

}