<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Cart\Take;

use Shop\Domain\Model\Cart\Cart;
use Shop\Domain\Model\Cart\CartAlreadyExists;
use Shop\Domain\Model\Cart\CartId;
use Shop\Domain\Model\Cart\CartRepository;

final class TakeCartService
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
     */
    public function execute(CartId $id)
    {
        if ($this->cartRepository->ofId($id) !== null) {
            throw new CartAlreadyExists($id);
        }

        $cart = new Cart($id);

        $this->cartRepository->save($cart);
    }
}