<?php

declare(strict_types = 1);

namespace Test\Shop\Domain\Shared;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Shop\Domain\Model\Shared\Currency;
use Shop\Domain\Model\Shared\Money;

final class MoneyTest extends TestCase
{
    public function testConstructValidMoney()
    {
        $money = new Money(5, new Currency('EUR'));

        $this->assertEquals('5EUR', $money->__toString());
    }

    public function testFromStringValidMoney()
    {
        $string = '5.5EUR';
        $money  = Money::fromString($string);

        $this->assertEquals($string, $money->__toString());
    }

    public function testFromStringInvalidMoney()
    {
        $string = '5,5EUR';
        $money  = Money::fromString($string);

        $this->assertNotEquals($string, $money->__toString());
    }

    public function testEqualsTrue()
    {
        $money1 = Money::fromString('5EUR');
        $money2 = Money::fromString('5EUR');

        $this->assertTrue($money1->equals($money2));
    }

    public function testEqualsFalse()
    {
        $money1 = Money::fromString('5EUR');
        $money2 = Money::fromString('6EUR');

        $this->assertFalse($money1->equals($money2));
    }

    public function testMultiplyMoney()
    {
        $string = '5.5EUR';
        $money1 = Money::fromString($string);

        $money2 = $money1->multiply(2);

        $this->assertEquals('11EUR', $money2->__toString());
        $this->assertNotSame($money1, $money2);
    }

    public function testAddNotValidMoney()
    {
        $this->expectException(InvalidArgumentException::class);

        $money1 = Money::fromString('5EUR');
        $money2 = Money::fromString('5USD');

        $money3 = $money1->add($money2);
    }

    public function testAddValidMoney()
    {
        $money1 = Money::fromString('5EUR');
        $money2 = Money::fromString('5EUR');

        $money3 = $money1->add($money2);

        $this->assertEquals('10EUR', $money3->__toString());
    }
}