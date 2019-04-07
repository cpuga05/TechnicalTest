<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Product\Create;

use Shop\Domain\Model\Product\Product;
use Shop\Domain\Model\Product\ProductAlreadyExists;
use Shop\Domain\Model\Product\ProductId;
use Shop\Domain\Model\Product\ProductRepository;
use Shop\Domain\Model\Shared\Money;
use Shop\Domain\Model\Shared\Unit;

final class CreateProductService
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param ProductId $id
     * @param string    $name
     * @param Money     $price
     * @param Unit      $offerUnits
     * @param Money     $offerPrice
     */
    public function execute(ProductId $id, string $name, Money $price, Unit $offerUnits, Money $offerPrice): void
    {
        if ($this->productRepository->ofId($id) !== null) {
            throw new ProductAlreadyExists($id);
        }

        $product = new Product($id, $name, $price, $offerUnits, $offerPrice);

        $this->productRepository->save($product);
    }
}