<?php

declare(strict_types = 1);

namespace Shop\Domain\Model\Product;

use DomainException;

final class ProductAlreadyExists extends DomainException
{
    public function __construct(ProductId $id)
    {
        parent::__construct('The product '.$id->id().' already exists.');
    }
}