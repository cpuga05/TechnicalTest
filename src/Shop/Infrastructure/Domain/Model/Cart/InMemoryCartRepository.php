<?php

declare(strict_types = 1);

namespace Shop\Infrastructure\Domain\Model\Cart;

use Shop\Domain\Model\Cart\Cart;
use Shop\Domain\Model\Cart\CartId;
use Shop\Domain\Model\Cart\CartRepository;

final class InMemoryCartRepository implements CartRepository
{
    /**
     * @var Cart[]
     */
    private $carts;

    public function __construct()
    {
        $this->carts = [];
    }

    /**
     * @param Cart $cart
     */
    public function save(Cart $cart): void
    {
        $this->carts[$cart->id()->id()] = $cart;
    }

    /**
     * @param CartId $id
     *
     * @return Cart|null
     */
    public function ofId(CartId $id): ?Cart
    {
        if (! isset($this->carts[$id->id()])) {
            return null;
        }

        return $this->carts[$id->id()];
    }
}