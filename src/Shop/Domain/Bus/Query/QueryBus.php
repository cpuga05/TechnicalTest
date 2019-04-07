<?php

declare(strict_types = 1);

namespace Shop\Domain\Bus\Query;

interface QueryBus
{
    /**
     * @param string $queryName
     * @param        $queryHandler
     */
    public function bind(string $queryName, $queryHandler): void;

    /**
     * @param Query $query
     *
     * @return Response
     */
    public function ask(Query $query): Response;
}