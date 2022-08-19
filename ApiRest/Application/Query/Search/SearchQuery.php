<?php

namespace ApiRest\Application\Query\Search;

class SearchQuery
{
    private string $queryParam;
    private ?bool $withDetails;

    public function __construct(
        string $queryParam,
        ?bool $withDetails
    )
    {
        $this->queryParam = $queryParam;
        $this->withDetails = $withDetails;
    }

    public function queryParam(): string
    {
        return $this->queryParam;
    }

    public function withDetails(): ?bool
    {
        return $this->withDetails;
    }
}