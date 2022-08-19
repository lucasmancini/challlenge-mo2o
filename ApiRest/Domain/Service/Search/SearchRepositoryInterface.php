<?php

namespace ApiRest\Domain\Service\Search;

interface SearchRepositoryInterface
{
    public function search(string $food, ?bool $withDetails): array;
}