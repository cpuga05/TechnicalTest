<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Cart\TakeProduct;

use Ramsey\Uuid\Uuid;
use Shop\Domain\Bus\Command\Command;

final class TakeProductCartCommand extends Command
{
    /**
     * @var string
     */
    private $cartId;

    /**
     * @var string
     */
    private $productId;

    /**
     * @var int
     */
    private $units;

    public function __construct(Uuid $commandId, string $cartId, string $productId, int $units)
    {
        parent::__construct($commandId);

        $this->cartId    = $cartId;
        $this->productId = $productId;
        $this->units     = $units;
    }

    /**
     * @return string
     */
    public function cartId(): string
    {
        return $this->cartId;
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
}