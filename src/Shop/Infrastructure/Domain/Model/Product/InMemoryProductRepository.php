<?php

declare(strict_types = 1);

namespace Shop\Infrastructure\Domain\Model\Product;

use Shop\Domain\Model\Product\Product;
use Shop\Domain\Model\Product\ProductId;
use Shop\Domain\Model\Product\ProductRepository;
use Shop\Domain\Model\Product\Products;

final class InMemoryProductRepository implements ProductRepository
{
    /**
     * @var Product[]
     */
    private $products;

    public function __construct()
    {
        $this->products = [];
    }

    /**
     * @param Product $product
     */
    public function save(Product $product): void
    {
        $this->products[$product->id()->id()] = $product;
    }

    /**
     * @param ProductId $id
     *
     * @return Product|null
     */
    public function ofId(ProductId $id): ?Product
    {
        if (! isset($this->products[$id->id()])) {
            return null;
        }

        return $this->products[$id->id()];
    }

    /**
     * @return Products
     */
    public function all(): Products
    {
        return new Products($this->products);
    }
}