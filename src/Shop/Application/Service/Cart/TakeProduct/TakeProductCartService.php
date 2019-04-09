<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Cart\TakeProduct;

use Shop\Domain\Model\Cart\CartFinder;
use Shop\Domain\Model\Cart\CartId;
use Shop\Domain\Model\Cart\CartNotExists;
use Shop\Domain\Model\Cart\CartRepository;
use Shop\Domain\Model\Product\ProductFinder;
use Shop\Domain\Model\Product\ProductId;
use Shop\Domain\Model\Product\ProductRepository;
use Shop\Domain\Model\Shared\Unit;

final class TakeProductCartService
{
    /**
     * @var CartFinder
     */
    private $cartFinder;

    /**
     * @var ProductFinder
     */
    private $productFinder;

    public function __construct(CartRepository $cartRepository, ProductRepository $productRepository)
    {
        $this->cartFinder    = new CartFinder($cartRepository);
        $this->productFinder = new ProductFinder($productRepository);
    }

    /**
     * @param CartId    $cartId
     * @param ProductId $productId
     * @param Unit      $unis
     *
     * @throws CartNotExists
     */
    public function execute(CartId $cartId, ProductId $productId, Unit $unis): void
    {
        $cart    = $this->cartFinder->execute($cartId);
        $product = $this->productFinder->execute($productId);

        $cart->takeProduct($productId, $unis, $product->price(), $product->offerUnits(), $product->offerPrice());
    }
}