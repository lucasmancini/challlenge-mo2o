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

        $response = $this->searchRepository->search( $queryParam );

        return new SearchResponse($response);
    }

}