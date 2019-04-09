<?php

declare(strict_types = 1);

namespace Test\Shop\Application\Cart\ChangeCurrency;

use PHPUnit\Framework\TestCase;
use Shop\Application\Service\Cart\ChangeCurrency\ChangeCurrencyCartService;
use Shop\Domain\Model\Shared\Currency;
use Shop\Domain\Model\Shared\Money;
use Shop\Domain\Model\Shared\MoneyConverter;

final class ChangeCurrencyCartServiceTest extends TestCase implements MoneyConverter
{
    public function testChangeCurrency()
    {
        $service = new ChangeCurrencyCartService($this);

        $money = $service->execute(Money::fromString('0EUR'), new Currency('USD'));

        $this->assertEquals('0 USD', $money->__toString());
    }

    public function convert(Money $money, Currency $currency): Money
    {
        return Money::fromString('0USD');
    }
}