<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Cart\ChangeCurrency;

use Shop\Domain\Model\Shared\Currency;
use Shop\Domain\Model\Shared\Money;
use Shop\Domain\Model\Shared\MoneyConverter;

final class ChangeCurrencyCartService
{
    /**
     * @var MoneyConverter
     */
    private $moneyConverter;

    public function __construct(MoneyConverter $moneyConverter)
    {
        $this->moneyConverter = $moneyConverter;
    }

    /**
     * @param Money    $money
     * @param Currency $currency
     *
     * @return Money
     */
    public function execute(Money $money, Currency $currency): Money
    {
        return $this->moneyConverter->convert($money, $currency);
    }
}