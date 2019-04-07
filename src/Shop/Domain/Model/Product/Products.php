<?php

declare(strict_types = 1);

namespace Shop\Domain\Model\Product;

use Shop\Domain\Collection;

final class Products extends Collection
{
    protected function type(): string
    {
        return Product::class;
    }
}