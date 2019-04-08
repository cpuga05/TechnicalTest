<?php

declare(strict_types = 1);

namespace Test\Shop\Domain\Cart;

use PHPUnit\Framework\TestCase;
use Shop\Domain\Model\Cart\CartId;
use Shop\Domain\Model\Cart\CartLine;
use Shop\Domain\Model\Cart\CartLines;
use Shop\Domain\Model\Product\ProductId;
use Shop\Domain\Model\Shared\Money;
use Shop\Domain\Model\Shared\Unit;

final class CartLinesTest extends TestCase
{
    public function testFindLineReturnedNull()
    {
        $cartLines = new CartLines([
            new CartLine(
                new CartId('1'),
                new ProductId('5'),
                new Unit(20),
                Money::fromString('5EUR'),
                new Unit(15),
                Money::fromString('4EUR')
            ),
        ]);

        $this->assertNull($cartLines->findLine(new ProductId('6')));
    }

    public function testFindLineReturnedCartLine()
    {
        $cartLine = new CartLine(
            new CartId('1'),
            new ProductId('5'),
            new Unit(20),
            Money::fromString('5EUR'),
            new Unit(15),
            Money::fromString('4EUR')
        );

        $cartLines = new CartLines([
            $cartLine,
        ]);

        $this->assertEquals($cartLine, $cartLines->findLine(new ProductId('5')));
    }
}