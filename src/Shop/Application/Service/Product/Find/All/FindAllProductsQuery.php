<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Product\Find\All;

use Ramsey\Uuid\Uuid;
use Shop\Domain\Bus\Query\Query;

final class FindAllProductsQuery extends Query
{
    public function __construct(Uuid $queryId)
    {
        parent::__construct($queryId);
    }
}