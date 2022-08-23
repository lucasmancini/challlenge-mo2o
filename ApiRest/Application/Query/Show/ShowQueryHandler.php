<?php

namespace ApiRest\Application\Query\Show;

use ApiRest\Domain\Service\Search\SearchRepositoryInterface;

class ShowQueryHandler
{

    private SearchRepositoryInterface $searchRepository;

    public function __construct(
        SearchRepositoryInterface $searchRepository
    )
    {
        $this->searchRepository = $searchRepository;
    }

    public function handle(ShowQuery $query):ShowResponse
    {
        $id = $query->id();

        $response = $this->searchRepository->details( $id );

        return new ShowResponse($response);
    }

}