<?php

declare(strict_types = 1);

namespace Test\Shop\Application\Product\Find\One;

use PHPUnit\Framework\TestCase;
use Shop\Application\Service\Product\Find\All\FindAllProductsService;
use Shop\Domain\Model\Product\Product;
use Shop\Domain\Model\Product\ProductId;
use Shop\Domain\Model\Product\ProductRepository;
use Shop\Domain\Model\Product\Products;

final class FindAllProductsServiceTest extends TestCase implements ProductRepository
{
    public function testExecute()
    {
        $this->expectNotToPerformAssertions();

        $service = new FindAllProductsService($this);

        $service->execute();
    }

    public function save(Product $product): void
    {
    }

    public function ofId(ProductId $id): ?Product
    {
        return null;
    }

    public function all(): Products
    {
        return new Products([]);
    }
}