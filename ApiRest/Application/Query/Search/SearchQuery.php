<?php

namespace ApiRest\Application\Query\Search;

class SearchQuery
{
    private string $queryParam;

    public function __construct(
        string $queryParam
    )
    {
        $this->queryParam = $queryParam;
    }

    public function queryParam(): string
    {
        return $this->queryParam;
    }
}