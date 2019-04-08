<?php

declare(strict_types = 1);

namespace Shop\Domain\Model\Cart;

use Shop\Domain\Model\Product\ProductId;
use Shop\Domain\Model\Shared\Currency;
use Shop\Domain\Model\Shared\Money;
use Shop\Domain\Model\Shared\Unit;

final class CartLine
{
    private const MAX_UNITS = 50;

    /**
     * @var CartId
     */
    private $cartId;

    /**
     * @var ProductId
     */
    private $productId;

    /**
     * @var Unit
     */
    private $units;

    /**
     * @var Money
     */
    private $unitPrice;

    /**
     * @var Unit
     */
    private $unitsOffer;

    /**
     * @var Money
     */
    private $offerPrice;

    /**
     * @var bool
     */
    private $offer;

    /**
     * @var Money
     */
    private $totalPrice;

    /**
     * @var Money
     */
    private $totalOfferPrice;

    public function __construct(
        CartId $cartId,
        ProductId $productId,
        Unit $units,
        Money $unitPrice,
        Unit $unitsOffer,
        Money $offerPrice
    ) {
        $this->assertNotMaxUnits($units);

        $this->cartId          = $cartId;
        $this->productId       = $productId;
        $this->units           = $units;
        $this->unitPrice       = $unitPrice;
        $this->unitsOffer      = $unitsOffer;
        $this->offerPrice      = $offerPrice;
        $this->offer           = false;
        $this->totalPrice      = new Money(0, new Currency('EUR'));
        $this->totalOfferPrice = new Money(0, new Currency('EUR'));

        $this->calculateTotalPrice();
    }

    /**
     * @param Unit $units
     */
    private function assertNotMaxUnits(Unit $units): void
    {
        if ($units->amount() > self::MAX_UNITS) {
            throw new CartLineMaxUnits();
        }
    }

    /**
     * @return void
     */
    private function calculateTotalPrice(): void
    {
        $this->offer           = false;
        $this->totalPrice      = $this->unitPrice->multiply($this->units->amount());
        $this->totalOfferPrice = new Money(0, new Currency('EUR'));


        if ($this->units->isBiggerOrEqualThan($this->unitsOffer)) {
            $this->offer           = true;
            $this->totalOfferPrice = $this->offerPrice->multiply($this->units->amount());
        }
    }

    /**
     * @param Unit $units
     */
    public function takeMoreUnits(Unit $units): void
    {
        $aUnits = $this->units->add($units);

        $this->assertNotMaxUnits($aUnits);

        $this->units = $aUnits;

        $this->calculateTotalPrice();
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->productId->id();
    }

    /**
     * @return CartId
     */
    public function cartId(): CartId
    {
        return $this->cartId;
    }

    /**
     * @return ProductId
     */
    public function productId(): ProductId
    {
        return $this->productId;
    }

    /**
     * @return Unit
     */
    public function units(): Unit
    {
        return $this->units;
    }

    /**
     * @return Money
     */
    public function unitPrice(): Money
    {
        return $this->unitPrice;
    }

    /**
     * @return Unit
     */
    public function unitsOffer(): Unit
    {
        return $this->unitsOffer;
    }

    /**
     * @return Money
     */
    public function offerPrice(): Money
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
     * @return Money
     */
    public function totalPrice(): Money
    {
        return $this->totalPrice;
    }

    /**
     * @return Money
     */
    public function totalOfferPrice(): Money
    {
        return $this->totalOfferPrice;
    }
}