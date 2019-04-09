<?php

declare(strict_types = 1);

namespace Shop\Domain\Model\Cart;

use Shop\Domain\Collection;
use Shop\Domain\Model\Product\ProductId;
use Shop\Domain\Model\Product\ProductNotExists;

final class CartLines extends Collection
{
    protected function type(): string
    {
        return CartLine::class;
    }

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

    /**
     * @param ProductId $id
     */
    public function removeLine(ProductId $id): void
    {
        foreach ($this->items() as $index => $item) {
            if ($id->equals($item->productId())) {
                $this->items = array_slice($this->items, $index + 1, 1);

                return;
            }
        }

        throw new ProductNotExists($id);
    }
}