<?php

declare(strict_types = 1);

namespace Shop\Domain\Model\Cart;

use Exception;
use Ramsey\Uuid\Uuid;

final class CartId
{
    /**
     * @var string
     */
    private $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return CartId
     * @throws Exception
     */
    public static function random(): self
    {
        return new self(Uuid::uuid4()->toString());
    }

    /**
     * @param CartId $productId
     *
     * @return bool
     */
    public function equals(CartId $productId): bool
    {
        return $this->id() === $productId->id();
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
    public function __toString(): string
    {
        return $this->id();
    }
}