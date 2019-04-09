<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Cart\RemoveProduct;

use Shop\Domain\Model\Cart\CartId;
use Shop\Domain\Model\Cart\CartNotExists;
use Shop\Domain\Model\Product\ProductId;

final class RemoveProductCartCommandHandler
{
    /**
     * @var RemoveProductCartService
     */
    private $productCartService;

    public function __construct(RemoveProductCartService $productCartService)
    {
        $this->productCartService = $productCartService;
    }

    /**
     * @param RemoveProductCartCommand $command
     *
     * @throws CartNotExists
     */
    public function handle(RemoveProductCartCommand $command): void
    {
        $cartId    = new CartId($command->cartId());
        $productId = new ProductId($command->productId());

        $this->productCartService->execute($cartId, $productId);
    }
}