<?php

declare(strict_types = 1);

namespace Shop\Domain\Bus\Query;

use Ramsey\Uuid\Uuid;

abstract class Query
{
    /**
     * @var Uuid
     */
    private $queryId;

    public function __construct(Uuid $queryId)
    {
        $this->queryId = $queryId;
    }

    /**
     * @return Uuid
     */
    public function queryId(): Uuid
    {
        return $this->queryId;
    }
}