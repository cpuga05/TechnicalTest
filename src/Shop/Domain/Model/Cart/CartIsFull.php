<?php

declare(strict_types = 1);

namespace Shop\Domain\Model\Cart;

use DomainException;

final class CartIsFull extends DomainException
{
    public function __construct()
    {
        parent::__construct('The cart is full');
    }
}