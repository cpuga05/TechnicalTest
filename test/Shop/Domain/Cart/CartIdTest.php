<?php

declare(strict_types = 1);

namespace Test\Shop\Domain\Cart;

use PHPUnit\Framework\TestCase;
use Shop\Domain\Model\Cart\CartId;

final class CartIdTest extends TestCase
{
    public function testConstruct()
    {
        $cartId = new CartId('5');

        $this->assertEquals('5', $cartId->id());
    }

    public function testConstructRandom()
    {
        $cartId = CartId::random();

        $this->assertInstanceOf(CartId::class, $cartId);
    }

    public function testEqualsTrue()
    {
        $cartId1 = new CartId('5');
        $cartId2 = new CartId('5');

        $this->assertTrue($cartId1->equals($cartId2));
    }

    public function testEqualsFalse()
    {
        $cartId1 = new CartId('5');
        $cartId2 = new CartId('6');

        $this->assertFalse($cartId1->equals($cartId2));
    }
}