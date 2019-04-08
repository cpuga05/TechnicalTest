<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Product\Find\One;

use Shop\Domain\Model\Product\Product;
use Shop\Domain\Model\Product\ProductId;
use Shop\Domain\Model\Product\ProductNotExists;
use Shop\Domain\Model\Product\ProductRepository;

final class FindOneProductService
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param ProductId $id
     *
     * @return Product
     */
    public function execute(ProductId $id): Product
    {
        $product = $this->productRepository->ofId($id);

        if ($product === null) {
            throw new ProductNotExists($id);
        }

        return $product;
    }
}