<?php

declare(strict_types = 1);

namespace Shop\Domain\Model\Shared;

use InvalidArgumentException;

final class Money
{
    /**
     * @var float
     */
    private $amount;

    /**
     * @var Currency
     */
    private $currency;

    public function __construct(float $amount, Currency $currency)
    {
        $this->amount   = $amount;
        $this->currency = $currency;
    }

    /**
     * @param string $money
     *
     * @return Money
     */
    public static function fromString(string $money): self
    {
        if (preg_match('/^([0-9]+(.[0-9]+)?)[ ]?([A-Z]{3})$/', $money, $groups) === 0) {
            throw new InvalidArgumentException('Not valid money from string');
        }

        return new self((float)$groups[1], new Currency($groups[3]));
    }

    /**
     * @param Money $money
     *
     * @return bool
     */
    public function equals(Money $money)
    {
        return $this->currency()->equals($money->currency()) && $this->amount() === $money->amount();
    }

    /**
     * @return Currency
     */
    public function currency(): Currency
    {
        return $this->currency;
    }

    /**
     * @return float
     */
    public function amount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $value
     *
     * @return Money
     */
    public function multiply(float $value): self
    {
        return new self($this->amount() * $value, $this->currency());
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->amount().$this->currency()->isoCode();
    }
}