<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Cart\View;

use Shop\Domain\Model\Cart\Cart;
use Shop\Domain\Model\Cart\CartId;
use Shop\Domain\Model\Cart\CartNotExists;
use Shop\Domain\Model\Cart\CartRepository;

final class ViewCartService
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