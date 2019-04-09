<?php

declare(strict_types = 1);

namespace Test\Shop\Domain\Cart;

use PHPUnit\Framework\TestCase;
use Shop\Domain\Model\Cart\CartId;
use Shop\Domain\Model\Cart\CartLine;
use Shop\Domain\Model\Cart\CartLineMaxUnits;
use Shop\Domain\Model\Product\ProductId;
use Shop\Domain\Model\Shared\Money;
use Shop\Domain\Model\Shared\Unit;

final class CartLineTest extends TestCase
{
    public function testConstructValid()
    {
        $cartLine = new CartLine(
            new CartId('1'),
            new ProductId('5'),
            new Unit(50),
            Money::fromString('5EUR'),
            new Unit(10),
            Money::fromString('4EUR')
        );

        $this->assertEquals('5', $cartLine->id());
    }

    public function testConstructNoValidUnits()
    {
        $this->expectException(CartLineMaxUnits::class);

        new CartLine(
            new CartId('1'),
            new ProductId('5'),
            new Unit(51),
            Money::fromString('5EUR'),
            new Unit(10),
            Money::fromString('4EUR')
        );
    }

    public function testTakeMoreUnitsValid()
    {
        $cartLine = new CartLine(
            new CartId('1'),
            new ProductId('5'),
            new Unit(20),
            Money::fromString('5EUR'),
            new Unit(10),
            Money::fromString('4EUR')
        );

        $cartLine->takeMoreUnits(new Unit(10));

        $this->assertEquals(30, $cartLine->units()->amount());
    }

    public function testTakeMoreUnitsInvalid()
    {
        $this->expectException(CartLineMaxUnits::class);

        $cartLine = new CartLine(
            new CartId('1'),
            new ProductId('5'),
            new Unit(20),
            Money::fromString('5EUR'),
            new Unit(10),
            Money::fromString('4EUR')
        );

        $cartLine->takeMoreUnits(new Unit(50));
    }

    public function testCalculateTotalPriceWithoutOffer()
    {
        $cartLine = new CartLine(
            new CartId('1'),
            new ProductId('5'),
            new Unit(10),
            Money::fromString('5EUR'),
            new Unit(15),
            Money::fromString('4EUR')
        );

        $this->assertFalse($cartLine->offer());
        $this->assertEquals('50 EUR', $cartLine->totalPrice());
        $this->assertEquals('0 EUR', $cartLine->totalOfferPrice());
    }

    public function testCalculateTotalPriceWithOffer()
    {
        $cartLine = new CartLine(
            new CartId('1'),
            new ProductId('5'),
            new Unit(20),
            Money::fromString('5EUR'),
            new Unit(15),
            Money::fromString('4EUR')
        );

        $this->assertTrue($cartLine->offer());
        $this->assertEquals('100 EUR', $cartLine->totalPrice());
        $this->assertEquals('80 EUR', $cartLine->totalOfferPrice());
    }
}