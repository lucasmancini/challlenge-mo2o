<?php

declare(strict_types=1);

namespace ApiRest\Domain\Search\Exception;

use DomainException;

final class SearchNotFound extends DomainException
{
    private const STATUS_CODE = 404;

    public function __construct(int $code, string $message = '')
    {
        parent::__construct( sprintf($message),$code );
    }
}
