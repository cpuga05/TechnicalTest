<?php

declare(strict_types = 1);

namespace Shop\Domain\Model\Product;

final class ProductFinder
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