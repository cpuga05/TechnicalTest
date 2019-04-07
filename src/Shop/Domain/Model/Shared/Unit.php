<?php

declare(strict_types = 1);

namespace Shop\Domain\Model\Shared;

use InvalidArgumentException;

final class Unit
{
    /**
     * @var int
     */
    private $amount;

    public function __construct(int $amount)
    {
        $this->ensureValidAmount($amount);

        $this->amount = $amount;
    }

    /**
     * @param int $amount
     */
    private function ensureValidAmount(int $amount)
    {
        if ($amount < 1) {
            throw new InvalidArgumentException('The amount '.$amount.' is not valid.');
        }
    }

    /**
     * @param Unit $unit
     *
     * @return bool
     */
    public function equals(Unit $unit): bool
    {
        return $this->amount() === $unit->amount();
    }

    /**
     * @param Unit $unit
     *
     * @return bool
     */
    public function isSmallerThan(Unit $unit): bool
    {
        return $this->amount() < $unit->amount();
    }

    /**
     * @param Unit $unit
     *
     * @return bool
     */
    public function isBiggerThan(Unit $unit): bool
    {
        return $this->amount() > $unit->amount();
    }

    /**
     * @param Unit $unit
     *
     * @return bool
     */
    public function isSmallerOrEqualThan(Unit $unit): bool
    {
        return $this->amount() <= $unit->amount();
    }

    /**
     * @param Unit $unit
     *
     * @return bool
     */
    public function isBiggerOrEqualThan(Unit $unit): bool
    {
        return $this->amount() >= $unit->amount();
    }

    /**
     * @param Unit $unit
     *
     * @return Unit
     */
    public function add(Unit $unit): self
    {
        return new Unit($this->amount() + $unit->amount());
    }

    /**
     * @return int
     */
    public function amount(): int
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->amount();
    }
}