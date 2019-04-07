<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Product\Find;

use Shop\Domain\Bus\Query\ResponseCollection;
use Shop\Domain\Model\Product\Products;

final class ProductsResponse extends ResponseCollection
{
    /**
     * @param Products $products
     *
     * @return ProductsResponse
     */
    public static function fromProducts(Products $products): self
    {
        $items = [];

        foreach ($products as $product) {
            $items[] = ProductResponse::fromProduct($product);
        }

        return new self($items);
    }

    protected function type(): string
    {
        return ProductResponse::class;
    }
}