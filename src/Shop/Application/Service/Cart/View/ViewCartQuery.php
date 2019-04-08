<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Cart\View;

use Ramsey\Uuid\Uuid;
use Shop\Domain\Bus\Query\Query;

final class ViewCartQuery extends Query
{
    /**
     * @var string
     */
    private $id;

    public function __construct(Uuid $queryId, string $id)
    {
        parent::__construct($queryId);
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }
}