<?php

declare(strict_types = 1);

namespace Shop\Application\Service\Cart\ChangeCurrency;

use Shop\Domain\Bus\Query\Response;
use Shop\Domain\Model\Shared\Money;

final class MoneyResponse implements Response
{
    /**
     * @var string
     */
    private $money;

    public function __construct(string $money)
    {
        $this->money = $money;
    }

    /**
     * @param Money $money
     *
     * @return MoneyResponse
     */
    public static function fromMoney(Money $money): self
    {
        return new self($money->__toString());
    }

    /**
     * @return string
     */
    public function money(): string
    {
        return $this->money;
    }
}