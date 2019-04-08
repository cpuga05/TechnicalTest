<?php

declare(strict_types = 1);

namespace Shop\Domain\Model\Cart;

final class CartFinder
{
    /**
     * @var CartRepository
     */
    private $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    /**
     * @param CartId $id
     *
     * @return Cart
     * @throws CartNotExists
     */
    public function execute(CartId $id): Cart
    {
        $cart = $this->cartRepository->ofId($id);

        if ($cart === null) {
            throw new CartNotExists($id);
        }

        return $cart;
    }
}