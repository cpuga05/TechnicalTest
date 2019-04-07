<?php

declare(strict_types = 1);

namespace Shop\Domain\Model\Product;

interface ProductRepository
{
    /**
     * @param Product $product
     */
    public function save(Product $product): void;

    /**
     * @param ProductId $id
     *
     * @return Product|null
     */
    public function ofId(ProductId $id): ?Product;

    /**
     * @return Products
     */
    public function all(): Products;
}