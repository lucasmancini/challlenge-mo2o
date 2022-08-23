<?php

namespace ApiRest\Application\Query\Show;

class ShowQuery
{
    private int $id;

    public function __construct(
        int $id
    )
    {
        $this->id = $id;
    }

    public function id(): int
    {
        return $this->id;
    }
}