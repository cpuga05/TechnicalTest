<?php

declare(strict_types = 1);

namespace Test\Shop\Application\Cart\TakeProduct;

use PHPUnit\Framework\TestCase;
use Shop\Application\Service\Cart\TakeProduct\TakeProductCartService;
use Shop\Domain\Model\Cart\Cart;
use Shop\Domain\Model\Cart\CartId;
use Shop\Domain\Model\Cart\CartRepository;
use Shop\Domain\Model\Product\Product;
use Shop\Domain\Model\Product\ProductId;
use Shop\Domain\Model\Product\ProductRepository;
use Shop\Domain\Model\Product\Products;
use Shop\Domain\Model\Shared\Money;
use Shop\Domain\Model\Shared\Unit;

final class TakeProductCartServiceTest extends TestCase
{
    public function testExecute()
    {
        $service = new TakeProductCartService(new MockCartRepository(), new MockProductRepository());
        $service->execute(CartId::random(), ProductId::random(), new Unit(5));

        $this->expectNotToPerformAssertions();
    }
}

final class MockCartRepository implements CartRepository
{
    public function save(Cart $cart): void
    {
    }

    public function ofId(CartId $id): ?Cart
    {
        return new Cart(CartId::random());
    }
}

final class MockProductRepository implements ProductRepository
{
    public function save(Product $product): void
    {
    }

    public function ofId(ProductId $id): ?Product
    {
        return new Product(
            ProductId::random(),
            'name',
            Money::fromString('1EUR'),
            new Unit(5),
            Money::fromString('0.5EUR')
        );
    }

    public function all(): Products
    {
        return new Products([]);
    }
}