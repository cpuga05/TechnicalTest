<?php

declare(strict_types = 1);

namespace Shop\Domain\Model\Product;

use Exception;
use Ramsey\Uuid\Uuid;

final class ProductId
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
     * @return ProductId
     * @throws Exception
     */
    public static function random(): self
    {
        return new self(Uuid::uuid4()->toString());
    }

    /**
     * @param ProductId $productId
     *
     * @return bool
     */
    public function equals(ProductId $productId): bool
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