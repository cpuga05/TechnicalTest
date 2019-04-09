<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Cart\RemoveProduct;

use Ramsey\Uuid\Uuid;
use Shop\Domain\Bus\Command\Command;

final class RemoveProductCartCommand extends Command
{
    /**
     * @var string
     */
    private $cartId;

    /**
     * @var string
     */
    private $productId;

    public function __construct(Uuid $commandId, string $cartId, string $productId)
    {
        parent::__construct($commandId);
        $this->cartId    = $cartId;
        $this->productId = $productId;
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
}