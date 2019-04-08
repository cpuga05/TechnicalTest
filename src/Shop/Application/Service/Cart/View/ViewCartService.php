<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Cart\View;

use Shop\Domain\Model\Cart\Cart;
use Shop\Domain\Model\Cart\CartFinder;
use Shop\Domain\Model\Cart\CartId;
use Shop\Domain\Model\Cart\CartNotExists;
use Shop\Domain\Model\Cart\CartRepository;

final class ViewCartService
{
    /**
     * @var CartFinder
     */
    private $cartFinder;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartFinder = new CartFinder($cartRepository);
    }

    /**
     * @param CartId $id
     *
     * @return Cart
     * @throws CartNotExists
     */
    public function execute(CartId $id): Cart
    {
        return $this->cartFinder->execute($id);
    }
}