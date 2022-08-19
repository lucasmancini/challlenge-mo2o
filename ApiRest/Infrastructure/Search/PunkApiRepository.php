<?php

namespace ApiRest\Infrastructure\Search;

use ApiRest\Domain\Search\Exception\SearchNotFound;
use ApiRest\Domain\Service\Search\SearchRepositoryInterface;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;

class PunkApiRepository implements SearchRepositoryInterface
{
    const HTTP_OK = 200;
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const WHITE_LIST_SEARCH = array( 'id', 'name', 'description');
    const WHITE_LIST_DETAILS = array( 'id', 'name', 'description', 'image_url', 'tagline', 'first_brewed');

    private RequestFactoryInterface $requestFactory;
    private StreamFactoryInterface $streamFactory;
    private ClientInterface $client;

    public function __construct(
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        ClientInterface $client
    )
    {
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
        $this->client = $client;
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function search(string $food, ?bool $withDetails ): array
    {
        $url = sprintf('%s?food=%s', 'https://api.punkapi.com/v2/beers', $food);

        $response = $this->client->sendRequest($this->createRequest($url, 'GET', ['id', 'name', 'description']));

        if ( self::HTTP_OK !== $response->getStatusCode()) {
            throw new SearchNotFound($response->getStatusCode(), $response->getReasonPhrase());
        }

        $array =  json_decode($response->getBody()->getContents(), true);

        $output = array_map( function ($element) use ($withDetails) {
                return $this->fieldsAllowed($element, $withDetails? self::WHITE_LIST_DETAILS : self::WHITE_LIST_SEARCH);
            },
            $array
        );

        return $output;
    }

    private function fieldsAllowed(array $element, array $white_list):array
    {
        return array_intersect_key( $element, array_flip( $white_list ) );
    }

    /**
     * @throws JsonException
     */
    protected function createRequest(string $url, string $method, array $content = null): RequestInterface
    {
        return $this->requestFactory
            ->createRequest($method, $url)
            ->withHeader('Content-Type', 'application/json')
            ;
    }

}