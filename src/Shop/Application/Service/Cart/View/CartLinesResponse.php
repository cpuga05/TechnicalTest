<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Cart\View;

use Shop\Domain\Bus\Query\ResponseCollection;
use Shop\Domain\Model\Cart\CartLines;

final class CartLinesResponse extends ResponseCollection
{
    /**
     * @param CartLines $cartLines
     *
     * @return CartLinesResponse
     */
    public static function fromCartLines(CartLines $cartLines): self
    {
        $items = [];

        foreach ($cartLines as $cartLine) {
            $items[] = CartLineResponse::fromCartLine($cartLine);
        }

        return new self($items);
    }

    /**
     * @return string
     */
    protected function type(): string
    {
        return CartLineResponse::class;
    }
}