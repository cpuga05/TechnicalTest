<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Product\Find\One;

use Shop\Domain\Model\Product\Product;
use Shop\Domain\Model\Product\ProductFinder;
use Shop\Domain\Model\Product\ProductId;
use Shop\Domain\Model\Product\ProductRepository;

final class FindOneProductService
{
    /**
     * @var ProductFinder
     */
    private $productFinder;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productFinder = new ProductFinder($productRepository);
    }

    /**
     * @param ProductId $id
     *
     * @return Product
     */
    public function execute(ProductId $id): Product
    {
        return $this->productFinder->execute($id);
    }
}