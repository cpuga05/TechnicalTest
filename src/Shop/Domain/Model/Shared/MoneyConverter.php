<?php

declare(strict_types = 1);

namespace Shop\Domain\Model\Shared;

interface MoneyConverter
{
    /**
     * @param Money    $money
     * @param Currency $currency
     *
     * @return Money
     */
    public function convert(Money $money, Currency $currency): Money;
}