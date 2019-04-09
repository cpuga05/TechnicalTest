<?php

declare(strict_types = 1);

namespace Test\Shop\Application\Cart\RemoveProduct;

use PHPUnit\Framework\TestCase;
use Shop\Application\Service\Cart\RemoveProduct\RemoveProductCartService;
use Shop\Application\Service\Product\Find\ProductResponse;
use Shop\Domain\Bus\Query\Query;
use Shop\Domain\Bus\Query\QueryBus;
use Shop\Domain\Bus\Query\Response;
use Shop\Domain\Model\Cart\Cart;
use Shop\Domain\Model\Cart\CartId;
use Shop\Domain\Model\Cart\CartRepository;
use Shop\Domain\Model\Product\Product;
use Shop\Domain\Model\Product\ProductId;
use Shop\Domain\Model\Shared\Money;
use Shop\Domain\Model\Shared\Unit;

final class RemoveProductCartServiceTest extends TestCase implements CartRepository, QueryBus
{
    public function testRemoveExistsProduct()
    {
        $this->expectNotToPerformAssertions();

        $service = new RemoveProductCartService($this, $this);

        $service->execute(CartId::random(), new ProductId('5'));
    }

    public function save(Cart $cart): void
    {
    }

    public function ofId(CartId $id): ?Cart
    {
        $cart = new Cart(CartId::random());

        $cart->takeProduct(
            new ProductId('5'),
            new Unit(5),
            Money::fromString('5EUR'),
            new Unit(10),
            Money::fromString('4EUR')
        );

        return $cart;
    }

    public function bind(string $queryName, $queryHandler): void
    {
    }

    public function ask(Query $query): Response
    {
        return ProductResponse::fromProduct(
            new Product(
                new ProductId('5'),
                'name',
                Money::fromString('1EUR'),
                new Unit(5),
                Money::fromString('0.5EUR')
            )
        );
    }
}