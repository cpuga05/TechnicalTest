<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Product\Find;

use Shop\Domain\Bus\Query\Response;
use Shop\Domain\Model\Product\Product;

final class ProductResponse implements Response
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $price;

    /**
     * @var int
     */
    private $offerUnits;

    /**
     * @var string
     */
    private $offerPrice;

    public function __construct(string $id, string $name, string $price, int $offerUnits, string $offerPrice)
    {
        $this->id         = $id;
        $this->name       = $name;
        $this->price      = $price;
        $this->offerUnits = $offerUnits;
        $this->offerPrice = $offerPrice;
    }

    /**
     * @param Product $product
     *
     * @return ProductResponse
     */
    public static function fromProduct(Product $product): self
    {
        return new self(
            $product->id()->id(),
            $product->name(),
            $product->price()->__toString(),
            $product->offerUnits()->amount(),
            $product->offerPrice()->__toString()
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
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function price(): string
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function offerUnits(): int
    {
        return $this->offerUnits;
    }

    /**
     * @return string
     */
    public function offerPrice(): string
    {
        return $this->offerPrice;
    }
}