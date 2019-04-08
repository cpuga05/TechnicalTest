<?php

declare(strict_types = 1);

namespace Shop\Domain\Model\Cart;

use Exception;

final class CartNotExists extends Exception
{
    public function __construct(CartId $id)
    {
        parent::__construct('The cart '.$id->id().' not exists.');
    }
}