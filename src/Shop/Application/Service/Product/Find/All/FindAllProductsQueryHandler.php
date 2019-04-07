<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Product\Find\All;

use Shop\Application\Service\Product\Find\ProductsResponse;

final class FindAllProductsQueryHandler
{
    /**
     * @var FindAllProductsService
     */
    private $findAllProductService;

    public function __construct(FindAllProductsService $findAllProductService)
    {
        $this->findAllProductService = $findAllProductService;
    }

    /**
     * @param FindAllProductsQuery $query
     *
     * @return ProductsResponse
     */
    public function handle(FindAllProductsQuery $query): ProductsResponse
    {
        return ProductsResponse::fromProducts($this->findAllProductService->execute());
    }
}