<?php

namespace ApiRest\Application\Query\Search;

class SearchResponse
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