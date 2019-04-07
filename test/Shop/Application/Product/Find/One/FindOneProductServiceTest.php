<?php

declare(strict_types = 1);

namespace Test\Shop\Application\Product\Find\One;

use PHPUnit\Framework\TestCase;
use Shop\Application\Service\Product\Find\One\FindOneProductService;
use Shop\Domain\Model\Product\Product;
use Shop\Domain\Model\Product\ProductId;
use Shop\Domain\Model\Product\ProductNotExists;
use Shop\Domain\Model\Product\ProductRepository;
use Shop\Domain\Model\Product\Products;
use Shop\Domain\Model\Shared\Money;
use Shop\Domain\Model\Shared\Unit;

final class FindOneProductServiceTest extends TestCase implements ProductRepository
{
    public function testNotExistsProduct()
    {
        $this->expectException(ProductNotExists::class);

        $service = new FindOneProductService($this);

        $service->execute(new ProductId('no'));
    }

    public function testExistsProduct()
    {
        $service = new FindOneProductService($this);

        $service->execute(new ProductId('yes'));

        $this->expectNotToPerformAssertions();
    }

    public function save(Product $product): void
    {
    }

    public function ofId(ProductId $id): ?Product
    {
        if ($id->id() === 'no') {
            return null;
        } else {
            return new Product(
                ProductId::random(),
                'name',
                Money::fromString('1EUR'),
                new Unit(5),
                Money::fromString('0.5EUR')
            );
        }
    }

    public function all(): Products
    {
        return null;
    }
}