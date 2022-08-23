<?php

namespace App\Controller\Search;

use App\Controller\Controller;
use ApiRest\Application\Query\Show\ShowQuery;
use ApiRest\Application\Query\Show\ShowQueryHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DetailsController extends Controller
{

    private ShowQueryHandler $handler;

    public function __construct(ShowQueryHandler $handler)
    {
        $this->handler = $handler;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $id = $request->get('id');

        $response = $this->handler->handle(New ShowQuery(
            $id
        ));

        return new JsonResponse(
            $response->result()
        );

    }


}