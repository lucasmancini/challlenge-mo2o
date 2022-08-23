<?php

namespace ApiRest\Infrastructure\Search;

use ApiRest\Domain\Search\Exception\SearchNotFound;
use ApiRest\Domain\Service\Search\SearchRepositoryInterface;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

class PunkApiRepository implements SearchRepositoryInterface
{
    const HTTP_OK = 200;
    const WHITE_LIST_SEARCH = array( 'id', 'name', 'description');
    const WHITE_LIST_DETAILS = array( 'id', 'name', 'description', 'image_url', 'tagline', 'first_brewed');

    private RequestFactoryInterface $requestFactory;
    private ClientInterface $client;

    public function __construct(
        RequestFactoryInterface $requestFactory,
        ClientInterface $client
    )
    {
        $this->requestFactory = $requestFactory;
        $this->client = $client;
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function search(string $food ): array
    {
        $url = sprintf('%s?food=%s', 'https://api.punkapi.com/v2/beers', $food);

        $response = $this->client->sendRequest( $this->requestFactory
            ->createRequest('GET', $url)
            ->withHeader('Content-Type', 'application/json')
        );

        if ( self::HTTP_OK !== $response->getStatusCode()) {
            throw new SearchNotFound($response->getStatusCode(), $response->getReasonPhrase());
        }

        $array =  json_decode($response->getBody()->getContents(), true);

        $output = array_map( function ($element) {
            return array_intersect_key( $element, array_flip( self::WHITE_LIST_SEARCH ) );
            },
            $array
        );

        return $output;
    }

    public function details(int $id): array
    {
        $url = sprintf('%s/%s', 'https://api.punkapi.com/v2/beers', $id);

        $response = $this->client->sendRequest( $this->requestFactory
                ->createRequest('GET', $url)
                ->withHeader('Content-Type', 'application/json')
        );

        if ( self::HTTP_OK !== $response->getStatusCode()) {
            throw new SearchNotFound($response->getStatusCode(), $response->getReasonPhrase());
        }

        $array =  json_decode($response->getBody()->getContents(), true);

        $output = array_map( function ($element) {
            return array_intersect_key( $element, array_flip( self::WHITE_LIST_DETAILS ) );
            },
            $array
        );

        return $output;
    }
}