<?php

declare(strict_types = 1);

namespace Test\Shop\Domain\Product;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Shop\Domain\Model\Product\Product;
use Shop\Domain\Model\Product\ProductId;
use Shop\Domain\Model\Shared\Money;
use Shop\Domain\Model\Shared\Unit;

final class ProductTest extends TestCase
{
    public function testRenameValidName()
    {
        $product = new Product(
            ProductId::random(),
            'Product',
            Money::fromString('5EUR'),
            new Unit(5),
            Money::fromString('4EUR')
        );

        $product->rename('Product new name');

        $this->assertEquals('Product new name', $product->name());
    }

    public function testRenameNullName()
    {
        $this->expectException(InvalidArgumentException::class);

        $product = new Product(
            ProductId::random(),
            'Product',
            Money::fromString('5EUR'),
            new Unit(5),
            Money::fromString('4EUR')
        );

        $product->rename((string)null);
    }

    public function testRenameEmptyName()
    {
        $this->expectException(InvalidArgumentException::class);

        $product = new Product(
            ProductId::random(),
            'Product',
            Money::fromString('5EUR'),
            new Unit(5),
            Money::fromString('4EUR')
        );

        $product->rename('');
    }
}