<?php

declare(strict_types = 1);

namespace Test\Shop\Domain\Shared;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Shop\Domain\Model\Shared\Currency;

final class CurrencyTest extends TestCase
{
    public function testConstructInvalidCurrency()
    {
        $this->expectException(InvalidArgumentException::class);

        new Currency('UVI');
    }

    public function testConstructValidCurrency()
    {
        $currency = new Currency('EUR');

        $this->assertEquals('EUR', $currency->isoCode());
    }

    public function testEqualsTrue()
    {
        $currency1 = new Currency('EUR');
        $currency2 = new Currency('EUR');

        $this->assertTrue($currency1->equals($currency2));
    }

    public function testEqualsFalse()
    {
        $currency1 = new Currency('EUR');
        $currency2 = new Currency('USD');

        $this->assertFalse($currency1->equals($currency2));
    }
}