<?php

declare(strict_types = 1);

namespace Shop\Domain\Model\Cart;

interface CartRepository
{
    /**
     * @param Cart $cart
     */
    public function save(Cart $cart): void;

    /**
     * @param CartId $id
     *
     * @return Cart|null
     */
    public function ofId(CartId $id): ?Cart;
}