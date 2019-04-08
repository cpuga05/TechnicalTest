<?php

declare(strict_types = 1);

namespace Shop\Domain\Model\Cart;

use DomainException;

final class CartLineMaxUnits extends DomainException
{
    public function __construct()
    {
        parent::__construct('The cart line has reached its maximum number of units');
    }
}