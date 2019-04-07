<?php

declare(strict_types = 1);

namespace Test\Shop\Domain\Product;

use PHPUnit\Framework\TestCase;
use Shop\Domain\Model\Product\ProductId;

final class ProductIdTest extends TestCase
{
    public function testConstruct()
    {
        $productId = new ProductId('5');

        $this->assertEquals('5', $productId->id());
    }

    public function testConstructRandom()
    {
        $productId = ProductId::random();

        $this->assertInstanceOf(ProductId::class, $productId);
    }

    public function testEqualsTrue()
    {
        $productId1 = new ProductId('5');
        $productId2 = new ProductId('5');

        $this->assertTrue($productId1->equals($productId2));
    }

    public function testEqualsFalse()
    {
        $productId1 = new ProductId('5');
        $productId2 = new ProductId('6');

        $this->assertFalse($productId1->equals($productId2));
    }
}