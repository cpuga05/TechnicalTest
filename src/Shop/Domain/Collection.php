<?php

declare(strict_types = 1);

namespace Shop\Domain;

use ArrayIterator;
use Countable;
use InvalidArgumentException;
use IteratorAggregate;
use Traversable;

abstract class Collection implements Countable, IteratorAggregate
{
    /**
     * @var array
     */
    private $items;

    public function __construct(array $items)
    {
        $this->ensureAllItemSameType($items);

        $this->items = $items;
    }

    /**
     * @param array $items
     */
    private function ensureAllItemSameType(array $items): void
    {
        foreach ($items as $item) {
            $this->ensureItemSameType($item);
        }
    }

    /**
     * @param $item
     */
    private function ensureItemSameType($item): void
    {
        $class = $this->type();

        if (! $item instanceof $class) {
            throw new InvalidArgumentException('The item not is type '.$class);
        }
    }

    /**
     * @return string
     */
    abstract protected function type(): string;

    public function add($item): void
    {
        $this->ensureItemSameType($item);

        $this->items[] = $item;
    }

    /**
     * @param int $index
     *
     * @return mixed|null
     */
    public function item(int $index)
    {
        if (! isset($this->items[$index])) {
            return null;
        }

        return $this->items[$index];
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->items());
    }

    /**
     * @return array
     */
    public function items(): array
    {
        return $this->items;
    }

    /**
     * @return Traversable
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items());
    }
}