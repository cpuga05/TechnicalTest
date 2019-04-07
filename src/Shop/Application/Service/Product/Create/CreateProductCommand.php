<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Product\Create;

use Ramsey\Uuid\Uuid;
use Shop\Domain\Bus\Command\Command;

final class CreateProductCommand extends Command
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

    public function __construct(
        Uuid $commandId,
        string $id,
        string $name,
        string $price,
        int $offerUnits,
        string $offerPrice
    ) {
        parent::__construct($commandId);

        $this->id         = $id;
        $this->name       = $name;
        $this->price      = $price;
        $this->offerUnits = $offerUnits;
        $this->offerPrice = $offerPrice;
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