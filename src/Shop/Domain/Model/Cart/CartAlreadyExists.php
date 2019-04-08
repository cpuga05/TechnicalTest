<?php

declare(strict_types = 1);

namespace Shop\Domain\Model\Cart;

use DomainException;

final class CartAlreadyExists extends DomainException
{
    public function __construct(CartId $id)
    {
        parent::__construct('The cart '.$id->id().' already exists.');
    }
}