<?php

declare(strict_types = 1);

namespace Test\Shop\Infrastructure\Domain\Model\Cart;

use PHPUnit\Framework\TestCase;
use Shop\Domain\Model\Cart\Cart;
use Shop\Domain\Model\Cart\CartId;
use Shop\Infrastructure\Domain\Model\Cart\InMemoryCartRepository;

final class InMemoryCartRepositoryTest extends TestCase
{
    public function testSaveAndOfId()
    {
        $repository = new InMemoryCartRepository();

        $cartId = CartId::random();
        $cart   = new Cart($cartId);

        $repository->save($cart);

        $this->assertEquals($cart, $repository->ofId($cartId));
    }

    public function testOfIdNotExists()
    {
        $repository = new InMemoryCartRepository();

        $cartId = CartId::random();

        $this->assertNull($repository->ofId($cartId));
    }
}