<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Cart\View;

use Shop\Domain\Bus\Query\Response;
use Shop\Domain\Model\Cart\Cart;

final class CartResponse implements Response
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var CartLinesResponse
     */
    private $lines;

    /**
     * @var string
     */
    private $totalPriceWithoutOffers;

    /**
     * @var string
     */
    private $totalPriceWithOffers;

    public function __construct(
        string $id,
        CartLinesResponse $lines,
        string $totalPriceWithoutOffers,
        string $totalPriceWithOffers
    ) {
        $this->id                      = $id;
        $this->lines                   = $lines;
        $this->totalPriceWithoutOffers = $totalPriceWithoutOffers;
        $this->totalPriceWithOffers    = $totalPriceWithOffers;
    }

    /**
     * @param Cart $cart
     *
     * @return CartResponse
     */
    public static function fromCart(Cart $cart): self
    {
        return new self(
            $cart->id()->id(),
            CartLinesResponse::fromCartLines($cart->lines()),
            $cart->totalPriceWithoutOffers()->__toString(),
            $cart->totalPriceWithOffers()->__toString()
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
     * @return CartLinesResponse
     */
    public function lines(): CartLinesResponse
    {
        return $this->lines;
    }

    /**
     * @return string
     */
    public function totalPriceWithoutOffers(): string
    {
        return $this->totalPriceWithoutOffers;
    }

    /**
     * @return string
     */
    public function totalPriceWithOffers(): string
    {
        return $this->totalPriceWithOffers;
    }
}