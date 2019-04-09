<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Cart\ChangeCurrency;

use Ramsey\Uuid\Uuid;
use Shop\Domain\Bus\Query\Query;

final class ChangeCurrencyCartQuery extends Query
{
    /**
     * @var string
     */
    private $money;

    /**
     * @var string
     */
    private $currency;

    public function __construct(Uuid $queryId, string $money, string $currency)
    {
        parent::__construct($queryId);
        $this->money    = $money;
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function money(): string
    {
        return $this->money;
    }

    /**
     * @return string
     */
    public function currency(): string
    {
        return $this->currency;
    }
}