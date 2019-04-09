<?php

declare(strict_types = 1);

namespace Test\Shop\Infrastructure\Domain\Model\Shared;

use PHPUnit\Framework\TestCase;
use Shop\Domain\Model\Shared\Currency;
use Shop\Domain\Model\Shared\Money;
use Shop\Infrastructure\Domain\Model\Shared\RestMoneyConverter;

final class RestMoneyConvertTest extends TestCase
{
    public function testConvert()
    {
        $moneyConvert = new RestMoneyConverter();

        $this->assertInstanceOf(
            Money::class,
            $moneyConvert->convert(Money::fromString('5EUR'), new Currency('USD'))
        );
    }
}