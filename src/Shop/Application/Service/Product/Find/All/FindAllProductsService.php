<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Product\Find\All;

use Shop\Domain\Model\Product\ProductRepository;
use Shop\Domain\Model\Product\Products;

final class FindAllProductsService
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(): Products
    {
        return $this->productRepository->all();
    }
}