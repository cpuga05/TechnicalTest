<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Cart\View;

use Shop\Domain\Model\Cart\CartLine;

final class CartLineResponse
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $productId;

    /**
     * @var int
     */
    private $units;

    /**
     * @var string
     */
    private $unitPrice;

    /**
     * @var int
     */
    private $unitsOffer;

    /**
     * @var string
     */
    private $offerPrice;

    /**
     * @var bool
     */
    private $offer;

    /**
     * @var string
     */
    private $totalPrice;

    public function __construct(
        string $id,
        string $productId,
        int $units,
        string $unitPrice,
        int $unitsOffer,
        string $offerPrice,
        bool $offer,
        string $totalPrice
    ) {
        $this->id         = $id;
        $this->productId  = $productId;
        $this->units      = $units;
        $this->unitPrice  = $unitPrice;
        $this->unitsOffer = $unitsOffer;
        $this->offerPrice = $offerPrice;
        $this->offer      = $offer;
        $this->totalPrice = $totalPrice;
    }

    /**
     * @param CartLine $cartLine
     *
     * @return CartLineResponse
     */
    public static function fromCartLine(CartLine $cartLine): self
    {
        return new self(
            $cartLine->id(),
            $cartLine->productId()->id(),
            $cartLine->units()->amount(),
            $cartLine->unitPrice()->__toString(),
            $cartLine->unitsOffer()->amount(),
            $cartLine->offerPrice()->__toString(),
            $cartLine->offer(),
            $cartLine->totalPrice()->__toString()
        );
    }
}