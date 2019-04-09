<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Cart\ChangeCurrency;

use Shop\Domain\Model\Shared\Currency;
use Shop\Domain\Model\Shared\Money;

final class ChangeCurrencyCartQueryHandler
{
    /**
     * @var ChangeCurrencyCartService
     */
    private $changeCurrencyCartService;

    public function __construct(ChangeCurrencyCartService $changeCurrencyCartService)
    {
        $this->changeCurrencyCartService = $changeCurrencyCartService;
    }

    /**
     * @param ChangeCurrencyCartQuery $query
     *
     * @return MoneyResponse
     */
    public function handle(ChangeCurrencyCartQuery $query): MoneyResponse
    {
        $money    = Money::fromString($query->money());
        $currency = new Currency($query->currency());

        return MoneyResponse::fromMoney($this->changeCurrencyCartService->execute($money, $currency));
    }
}