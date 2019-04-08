<?php

declare(strict_types = 1);

namespace Test\Shop\Domain\Cart;

use PHPUnit\Framework\TestCase;
use Shop\Domain\Model\Cart\Cart;
use Shop\Domain\Model\Cart\CartId;
use Shop\Domain\Model\Cart\CartIsFull;
use Shop\Domain\Model\Product\ProductId;
use Shop\Domain\Model\Shared\Money;
use Shop\Domain\Model\Shared\Unit;

final class CartTest extends TestCase
{
    public function testConstruct()
    {
        $cartId = CartId::random();
        $cart   = new Cart($cartId);

        $this->assertTrue($cart->id()->equals($cartId));
    }

    public function testTakeNewProduct()
    {
        $cart = new Cart(CartId::random());

        $cart->takeProduct(
            new ProductId('5'),
            new Unit(5),
            Money::fromString('5EUR'),
            new Unit(10),
            Money::fromString('4EUR')
        );

        $this->assertEquals('25EUR', $cart->totalPriceWithoutOffers()->__toString());
        $this->assertEquals('25EUR', $cart->totalPriceWithOffers()->__toString());
    }

    public function testTakeNewProductWithOffer()
    {
        $cart = new Cart(CartId::random());

        $cart->takeProduct(
            new ProductId('5'),
            new Unit(10),
            Money::fromString('5EUR'),
            new Unit(10),
            Money::fromString('4EUR')
        );

        $this->assertEquals('50EUR', $cart->totalPriceWithoutOffers()->__toString());
        $this->assertEquals('40EUR', $cart->totalPriceWithOffers()->__toString());
    }

    public function testTakeExistsProduct()
    {
        $cart = new Cart(CartId::random());

        $cart->takeProduct(
            new ProductId('5'),
            new Unit(1),
            Money::fromString('5EUR'),
            new Unit(10),
            Money::fromString('4EUR')
        );

        $cart->takeProduct(
            new ProductId('5'),
            new Unit(1),
            Money::fromString('5EUR'),
            new Unit(10),
            Money::fromString('4EUR')
        );

        $this->assertEquals('10EUR', $cart->totalPriceWithoutOffers()->__toString());
        $this->assertEquals('10EUR', $cart->totalPriceWithOffers()->__toString());
    }

    public function testTakeExistsProductWithOffer()
    {
        $cart = new Cart(CartId::random());

        $cart->takeProduct(
            new ProductId('5'),
            new Unit(5),
            Money::fromString('5EUR'),
            new Unit(10),
            Money::fromString('4EUR')
        );

        $cart->takeProduct(
            new ProductId('5'),
            new Unit(5),
            Money::fromString('5EUR'),
            new Unit(10),
            Money::fromString('4EUR')
        );

        $this->assertEquals('50EUR', $cart->totalPriceWithoutOffers()->__toString());
        $this->assertEquals('40EUR', $cart->totalPriceWithOffers()->__toString());
    }

    public function testTakeNewProductWithCartNotFull()
    {
        $cart = new Cart(CartId::random());

        $cart->takeProduct(
            new ProductId('5'),
            new Unit(1),
            Money::fromString('5EUR'),
            new Unit(10),
            Money::fromString('4EUR')
        );

        $cart->takeProduct(
            new ProductId('6'),
            new Unit(2),
            Money::fromString('10EUR'),
            new Unit(10),
            Money::fromString('5EUR')
        );

        $this->assertEquals('25EUR', $cart->totalPriceWithoutOffers()->__toString());
        $this->assertEquals('25EUR', $cart->totalPriceWithOffers()->__toString());
    }

    public function testTakeNewProductWithCartFull()
    {
        $this->expectException(CartIsFull::class);

        $cart = new Cart(CartId::random());

        for ($i = 0; $i < 10; $i++) {
            $cart->takeProduct(
                new ProductId((string)$i),
                new Unit(1),
                Money::fromString('5EUR'),
                new Unit(10),
                Money::fromString('4EUR')
            );
        }

        $cart->takeProduct(
            new ProductId('11'),
            new Unit(1),
            Money::fromString('5EUR'),
            new Unit(10),
            Money::fromString('4EUR')
        );
    }
}