<?php

declare(strict_types = 1);

namespace Shop\Domain\Model\Product;

use InvalidArgumentException;
use Shop\Domain\Model\Shared\Money;
use Shop\Domain\Model\Shared\Unit;

final class Product
{
    /**
     * @var ProductId
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Money
     */
    private $price;

    /**
     * @var Unit
     */
    private $offerUnits;

    /**
     * @var Money
     */
    private $offerPrice;

    public function __construct(ProductId $id, string $name, Money $price, Unit $offerUnits, Money $offerPrice)
    {
        $this->id         = $id;
        $this->price      = $price;
        $this->offerUnits = $offerUnits;
        $this->offerPrice = $offerPrice;

        $this->rename($name);
    }

    /**
     * @param string $name
     */
    public function rename(string $name): void
    {
        $this->ensureNameIsNotNull($name);
        $this->ensureNameIsNotEmpty($name);

        $this->name = $name;
    }

    /**
     * @param string $name
     */
    private function ensureNameIsNotNull(string $name): void
    {
        if ($name === null) {
            throw new InvalidArgumentException('The name is empty');
        }
    }

    /**
     * @param string $name
     */
    private function ensureNameIsNotEmpty(string $name): void
    {
        if (strlen($name) === 0) {
            throw new InvalidArgumentException('The name is empty');
        }
    }

    /**
     * @return ProductId
     */
    public function id(): ProductId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return Money
     */
    public function price(): Money
    {
        return $this->price;
    }

    /**
     * @return Unit
     */
    public function offerUnits(): Unit
    {
        return $this->offerUnits;
    }

    /**
     * @return Money
     */
    public function offerPrice(): Money
    {
        return $this->offerPrice;
    }
}