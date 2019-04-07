<?php

declare(strict_types = 1);

namespace Test\Shop\Application\Product\Create;

use PHPUnit\Framework\TestCase;
use Shop\Application\Service\Product\Create\CreateProductService;
use Shop\Domain\Model\Product\Product;
use Shop\Domain\Model\Product\ProductAlreadyExists;
use Shop\Domain\Model\Product\ProductId;
use Shop\Domain\Model\Product\ProductRepository;
use Shop\Domain\Model\Product\Products;
use Shop\Domain\Model\Shared\Money;
use Shop\Domain\Model\Shared\Unit;

final class CreateProductServiceTest extends TestCase implements ProductRepository
{
    public function testNotExistsProduct()
    {
        $service = new CreateProductService($this);

        $service->execute(
            new ProductId('no'),
            'name',
            Money::fromString('1EUR'),
            new Unit(5),
            Money::fromString('0.5EUR')
        );

        $this->expectNotToPerformAssertions();
    }

    public function testExistsProduct()
    {
        $this->expectException(ProductAlreadyExists::class);

        $service = new CreateProductService($this);

        $service->execute(
            new ProductId('yes'),
            'name',
            Money::fromString('1EUR'),
            new Unit(5),
            Money::fromString('0.5EUR')
        );
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