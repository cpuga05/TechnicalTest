<?php

namespace Test\Shop\Domain;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Shop\Domain\Collection;

class CollectionTest extends TestCase
{
    public function testConstructEmptyCollection()
    {
        $collection = new ThingCollection([]);

        $this->assertEquals([], $collection->items());
    }

    public function testConstructInvalidCollection()
    {
        $this->expectException(InvalidArgumentException::class);

        new ThingCollection([new Thing(), '5']);
    }

    public function testConstructValidCollection()
    {
        $thing1     = new Thing();
        $thing2     = new Thing();
        $collection = new ThingCollection([$thing1, $thing2]);

        $this->assertEquals([$thing1, $thing2], $collection->items());
    }

    public function testItemExists()
    {
        $thing1     = new Thing();
        $thing2     = new Thing();
        $collection = new ThingCollection([$thing1, $thing2]);

        $this->assertEquals($thing1, $collection->item(0));
    }

    public function testItemNotExists()
    {
        $thing1     = new Thing();
        $thing2     = new Thing();
        $collection = new ThingCollection([$thing1, $thing2]);

        $this->assertEquals(null, $collection->item(10));
    }

    public function testAddValidItem()
    {
        $thing1     = new Thing();
        $thing2     = new Thing();
        $collection = new ThingCollection([$thing1]);

        $collection->add($thing2);

        $this->assertEquals($thing2, $collection->item(1));
        $this->assertEquals(2, $collection->count());
    }

    public function testAddInvalidItem()
    {
        $this->expectException(InvalidArgumentException::class);

        $thing1     = new Thing();
        $collection = new ThingCollection([$thing1]);

        $collection->add('a');
    }
}

class ThingCollection extends Collection
{
    protected function type(): string
    {
        return Thing::class;
    }
}

class Thing
{

}
