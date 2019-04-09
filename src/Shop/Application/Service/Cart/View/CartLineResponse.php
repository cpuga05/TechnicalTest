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

    /**
     * @var string
     */
    private $totalOfferPrice;

    public function __construct(
        string $id,
        string $productId,
        int $units,
        string $unitPrice,
        int $unitsOffer,
        string $offerPrice,
        bool $offer,
        string $totalPrice,
        string $totalOfferPrice
    ) {
        $this->id              = $id;
        $this->productId       = $productId;
        $this->units           = $units;
        $this->unitPrice       = $unitPrice;
        $this->unitsOffer      = $unitsOffer;
        $this->offerPrice      = $offerPrice;
        $this->offer           = $offer;
        $this->totalPrice      = $totalPrice;
        $this->totalOfferPrice = $totalOfferPrice;
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
            $cartLine->totalPrice()->__toString(),
            $cartLine->totalOfferPrice()->__toString()
        );
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function productId(): string
    {
        return $this->productId;
    }

    /**
     * @return int
     */
    public function units(): int
    {
        return $this->units;
    }

    /**
     * @return string
     */
    public function unitPrice(): string
    {
        return $this->unitPrice;
    }

    /**
     * @return int
     */
    public function unitsOffer(): int
    {
        return $this->unitsOffer;
    }

    /**
     * @return string
     */
    public function offerPrice(): string
    {
        return $this->offerPrice;
    }

    /**
     * @return bool
     */
    public function offer(): bool
    {
        return $this->offer;
    }

    /**
     * @return string
     */
    public function totalPrice(): string
    {
        return $this->totalPrice;
    }

    /**
     * @return string
     */
    public function totalOfferPrice(): string
    {
        return $this->totalOfferPrice;
    }
}