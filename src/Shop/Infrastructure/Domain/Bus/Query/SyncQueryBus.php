<?php

declare(strict_types = 1);

namespace Shop\Infrastructure\Domain\Bus\Query;

use BadMethodCallException;
use Shop\Domain\Bus\Query\Query;
use Shop\Domain\Bus\Query\QueryBus;
use Shop\Domain\Bus\Query\Response;

final class SyncQueryBus implements QueryBus
{
    /**
     * @var array
     */
    private $handlers;

    public function __construct()
    {
        $this->handlers = [];
    }

    /**
     * @param string $queryName
     * @param        $queryHandler
     */
    public function bind(string $queryName, $queryHandler): void
    {
        $this->handlers[$queryName] = $queryHandler;
    }

    /**
     * @param Query $query
     *
     * @return Response
     */
    public function ask(Query $query): Response
    {
        $queryName = get_class($query);

        if (! isset($this->handlers[$queryName])) {
            throw new BadMethodCallException('Query not registered');
        }

        return $this->handlers[$queryName]->handle($query);
    }
}