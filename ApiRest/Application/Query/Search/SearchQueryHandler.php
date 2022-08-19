<?php

namespace ApiRest\Application\Query\Search;

use ApiRest\Domain\Service\Search\SearchRepositoryInterface;

class SearchQueryHandler
{

    private SearchRepositoryInterface $searchRepository;

    public function __construct(
        SearchRepositoryInterface $searchRepository
    )
    {
        $this->searchRepository = $searchRepository;
    }

    public function handle(SearchQuery $query):SearchResponse
    {
        $queryParam = $query->queryParam();

        $withDetails = $query->withDetails();

        $response = $this->searchRepository->search( $queryParam, $withDetails );

        return new SearchResponse($response);
    }

}