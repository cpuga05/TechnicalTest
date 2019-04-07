<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Product\Find\One;

use Shop\Application\Service\Product\Find\ProductResponse;
use Shop\Domain\Model\Product\ProductId;

final class FindOneProductQueryHandler
{
    /**
     * @var FindOneProductService
     */
    private $findOneProductService;

    public function __construct(FindOneProductService $findOneProductService)
    {
        $this->findOneProductService = $findOneProductService;
    }

    /**
     * @param FindOneProductQuery $query
     *
     * @return ProductResponse
     */
    public function handle(FindOneProductQuery $query): ProductResponse
    {
        $id = new ProductId($query->id());

        return ProductResponse::fromProduct($this->findOneProductService->execute($id));
    }
}