<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Cart\RemoveProduct;

use Ramsey\Uuid\Uuid;
use Shop\Application\Service\Product\Find\One\FindOneProductQuery;
use Shop\Domain\Bus\Query\QueryBus;
use Shop\Domain\Model\Cart\CartFinder;
use Shop\Domain\Model\Cart\CartId;
use Shop\Domain\Model\Cart\CartNotExists;
use Shop\Domain\Model\Cart\CartRepository;
use Shop\Domain\Model\Product\ProductId;

final class RemoveProductCartService
{
    /**
     * @var QueryBus
     */
    private $queryBus;

    /**
     * @var CartFinder
     */
    private $cartFinder;

    public function __construct(CartRepository $cartRepository, QueryBus $queryBus)
    {
        $this->queryBus   = $queryBus;
        $this->cartFinder = new CartFinder($cartRepository);
    }

    /**
     * @param CartId    $cartId
     * @param ProductId $productId
     *
     * @throws CartNotExists
     */
    public function execute(CartId $cartId, ProductId $productId): void
    {
        $this->ensureProductExists($productId);

        $cart = $this->cartFinder->execute($cartId);

        $cart->removeProduct($productId);
    }

    private function ensureProductExists(ProductId $productId): void
    {
        $this->queryBus->ask(new FindOneProductQuery(Uuid::uuid4(), $productId->id()));
    }
}