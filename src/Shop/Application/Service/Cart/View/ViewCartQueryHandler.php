<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Cart\View;

use Shop\Domain\Model\Cart\CartId;
use Shop\Domain\Model\Cart\CartNotExists;

final class ViewCartQueryHandler
{
    /**
     * @var ViewCartService
     */
    private $viewCartService;

    public function __construct(ViewCartService $viewCartService)
    {
        $this->viewCartService = $viewCartService;
    }

    /**
     * @param ViewCartQuery $query
     *
     * @return CartResponse
     * @throws CartNotExists
     */
    public function handle(ViewCartQuery $query): CartResponse
    {
        $id = new CartId($query->id());

        return CartResponse::fromCart($this->viewCartService->execute($id));
    }
}