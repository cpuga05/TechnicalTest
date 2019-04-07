<?php

declare(strict_types = 1);

namespace Test\Shop\Domain\Shared;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Shop\Domain\Model\Shared\Unit;

final class UnitTest extends TestCase
{
    public function testConstructInvalidUnit()
    {
        $this->expectException(InvalidArgumentException::class);

        new Unit(0);
    }

    public function testConstructValidUnit()
    {
        $unit = new Unit(1);

        $this->assertEquals(1, $unit->amount());
        $this->assertEquals(1, $unit->__toString());
    }

    public function testEqualsReturnTrue()
    {
        $unit1 = new Unit(5);
        $unit2 = new Unit(5);

        $this->assertTrue($unit1->equals($unit2));
    }

    public function testEqualsReturnFalse()
    {
        $unit1 = new Unit(5);
        $unit2 = new Unit(10);

        $this->assertFalse($unit1->equals($unit2));
    }

    public function testIsSmallerThanReturnTrue()
    {
        $unit1 = new Unit(5);
        $unit2 = new Unit(6);

        $this->assertTrue($unit1->isSmallerThan($unit2));
    }

    public function testIsSmallerThanReturnFalse()
    {
        $unit1 = new Unit(5);
        $unit2 = new Unit(4);

        $this->assertFalse($unit1->isSmallerThan($unit2));
    }

    public function testIsBiggerThanReturnTrue()
    {
        $unit1 = new Unit(5);
        $unit2 = new Unit(4);

        $this->assertTrue($unit1->isBiggerThan($unit2));
    }

    public function testIsBiggerThanReturnFalse()
    {
        $unit1 = new Unit(5);
        $unit2 = new Unit(6);

        $this->assertFalse($unit1->isBiggerThan($unit2));
    }

    public function testIsSmallerOrEqualThanReturnTrue()
    {
        $unit1 = new Unit(5);
        $unit2 = new Unit(5);

        $this->assertTrue($unit1->isSmallerOrEqualThan($unit2));
    }

    public function testIsSmallerOrEqualThanReturnFalse()
    {
        $unit1 = new Unit(5);
        $unit2 = new Unit(4);

        $this->assertFalse($unit1->isSmallerOrEqualThan($unit2));
    }

    public function testIsBiggerOrEqualThanReturnTrue()
    {
        $unit1 = new Unit(5);
        $unit2 = new Unit(5);

        $this->assertTrue($unit1->isBiggerOrEqualThan($unit2));
    }

    public function testIsBiggerOrEqualThanReturnFalse()
    {
        $unit1 = new Unit(5);
        $unit2 = new Unit(6);

        $this->assertFalse($unit1->isBiggerOrEqualThan($unit2));
    }
}