<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Product\Create;

use Shop\Domain\Model\Product\ProductId;
use Shop\Domain\Model\Shared\Money;
use Shop\Domain\Model\Shared\Unit;

final class CreateProductCommandHandler
{
    /**
     * @var CreateProductService
     */
    private $createProductService;

    public function __construct(CreateProductService $createProductService)
    {
        $this->createProductService = $createProductService;
    }

    /**
     * @param CreateProductCommand $command
     */
    public function handle(CreateProductCommand $command): void
    {
        $id         = new ProductId($command->id());
        $name       = $command->name();
        $price      = Money::fromString($command->price());
        $offerUnits = new Unit($command->offerUnits());
        $offerPrice = Money::fromString($command->offerPrice());

        $this->createProductService->execute($id, $name, $price, $offerUnits, $offerPrice);
    }
}