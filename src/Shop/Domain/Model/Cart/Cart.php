<?php

declare(strict_types = 1);

namespace Shop\Domain\Model\Cart;

use Shop\Domain\Model\Product\ProductId;
use Shop\Domain\Model\Shared\Currency;
use Shop\Domain\Model\Shared\Money;
use Shop\Domain\Model\Shared\Unit;

final class Cart
{
    /**
     * @var CartId
     */
    private $id;

    /**
     * @var CartLines
     */
    private $lines;

    /**
     * @var Money
     */
    private $totalPriceWithoutOffers;

    /**
     * @var Money
     */
    private $totalPriceWithOffers;

    public function __construct(CartId $id)
    {
        $this->id                      = $id;
        $this->lines                   = new CartLines([]);
        $this->totalPriceWithoutOffers = new Money(0, new Currency('EUR'));
        $this->totalPriceWithOffers    = new Money(0, new Currency('EUR'));
    }

    /**
     * @param ProductId $productId
     * @param Unit      $units
     * @param Money     $unitPrice
     * @param Unit      $unitsOffer
     * @param Money     $offerPrice
     */
    public function takeProduct(
        ProductId $productId,
        Unit $units,
        Money $unitPrice,
        Unit $unitsOffer,
        Money $offerPrice
    ): void {
        $this->ensureCartNotIsFull();

        $line = $this->lines->findLine($productId);

        if ($line !== null) {
            $line->takeMoreUnits($units);
        } else {
            $this->lines->add(new CartLine($this->id(), $productId, $units, $unitPrice, $unitsOffer, $offerPrice));
        }

        $this->calculateTotalPrice();
    }

    private function ensureCartNotIsFull(): void
    {
        if ($this->lines->count() === 10) {
            throw new CartIsFull();
        }
    }

    /**
     * @param ProductId $productId
     */
    public function removeProduct(ProductId $productId): void
    {
        $this->lines->removeLine($productId);
        $this->calculateTotalPrice();
    }

    /**
     * @return CartId
     */
    public function id(): CartId
    {
        return $this->id;
    }

    private function calculateTotalPrice(): void
    {
        $this->totalPriceWithoutOffers = $this->totalPriceWithOffers = new Money(0, new Currency('EUR'));

        foreach ($this->lines() as $line) {
            $this->totalPriceWithoutOffers = $this->totalPriceWithoutOffers->add($line->totalPrice());

            if ($line->offer()) {
                $this->totalPriceWithOffers = $this->totalPriceWithOffers->add($line->totalOfferPrice());
            } else {
                $this->totalPriceWithOffers = $this->totalPriceWithOffers->add($line->totalPrice());
            }
        }
    }

    /**
     * @return CartLines
     */
    public function lines(): CartLines
    {
        return $this->lines;
    }

    /**
     * @return Money
     */
    public function totalPriceWithoutOffers(): Money
    {
        return $this->totalPriceWithoutOffers;
    }

    /**
     * @return Money
     */
    public function totalPriceWithOffers(): Money
    {
        return $this->totalPriceWithOffers;
    }
}