<?php

namespace ApiRest\Domain\Service\Search;

interface SearchRepositoryInterface
{
    public function search(string $food): array;

    public function details(int $id): array;

}