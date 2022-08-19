<?php

namespace App\Controller\Search;

use App\Controller\Controller;
use ApiRest\Application\Query\Search\SearchQuery;
use ApiRest\Application\Query\Search\SearchQueryHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{

    private SearchQueryHandler $handler;

    public function __construct(SearchQueryHandler $handler)
    {
        $this->handler = $handler;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $queryParam = $request->get('food','');

        $response = $this->handler->handle(New SearchQuery(
            $queryParam,
            null
        ));

        return new JsonResponse(
            $response->result()
        );
    }
}