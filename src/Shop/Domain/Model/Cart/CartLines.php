<?php

declare(strict_types = 1);

namespace Shop\Domain\Model\Cart;

use Shop\Domain\Collection;
use Shop\Domain\Model\Product\ProductId;

final class CartLines extends Collection
{
    /**
     * @param ProductId $id
     *
     * @return mixed|null
     */
    public function findLine(ProductId $id)
    {
        foreach ($this->items() as $item) {
            if ($id->equals($item->productId())) {
                return $item;
            }
        }

        return null;
    }

    protected function type(): string
    {
        return CartLine::class;
    }
}