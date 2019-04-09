<?php

declare(strict_types = 1);

namespace Test\Shop\Infrastructure\Domain\Model\Product;

use PHPUnit\Framework\TestCase;
use Shop\Domain\Model\Product\Product;
use Shop\Domain\Model\Product\ProductId;
use Shop\Domain\Model\Shared\Money;
use Shop\Domain\Model\Shared\Unit;
use Shop\Infrastructure\Domain\Model\Product\InMemoryProductRepository;

final class InMemoryProductRepositoryTest extends TestCase
{
    public function testSaveAndOfId()
    {
        $repository = new InMemoryProductRepository();

        $productId = ProductId::random();
        $product   = new Product(
            $productId,
            'name',
            Money::fromString('1EUR'),
            new Unit(5),
            Money::fromString('0.5EUR')
        );

        $repository->save($product);

        $this->assertEquals($product, $repository->ofId($productId));
    }

    public function testOfIdNotExists()
    {
        $repository = new InMemoryProductRepository();

        $productId = ProductId::random();

        $this->assertNull($repository->ofId($productId));
    }

    public function testAllEmpty()
    {
        $repository = new InMemoryProductRepository();

        $this->assertCount(0, $repository->all());
    }

    public function testAll()
    {
        $repository = new InMemoryProductRepository();

        $productId = ProductId::random();
        $product   = new Product(
            $productId,
            'name',
            Money::fromString('1EUR'),
            new Unit(5),
            Money::fromString('0.5EUR')
        );

        $repository->save($product);

        $this->assertCount(1, $repository->all());
    }
}