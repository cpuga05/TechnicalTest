<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Cart\TakeProduct;

use Shop\Domain\Model\Cart\CartId;
use Shop\Domain\Model\Cart\CartNotExists;
use Shop\Domain\Model\Product\ProductId;
use Shop\Domain\Model\Shared\Unit;

final class TakeProductCartCommandHandler
{
    /**
     * @var TakeProductCartService
     */
    private $takeProductCartService;

    public function __construct(TakeProductCartService $takeProductCartService)
    {
        $this->takeProductCartService = $takeProductCartService;
    }

    /**
     * @param TakeProductCartCommand $command
     *
     * @throws CartNotExists
     */
    public function handle(TakeProductCartCommand $command): void
    {
        $cartId    = new CartId($command->cartId());
        $productId = new ProductId($command->productId());
        $units     = new Unit($command->units());

        $this->takeProductCartService->execute($cartId, $productId, $units);
    }
}