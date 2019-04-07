<?php

declare(strict_types = 1);

namespace Shop\Domain\Model\Shared;

use InvalidArgumentException;

final class Currency
{
    private const VALID = [
        'EUR',
        'USD',
        'JPY',
        'BGN',
        'CZK',
        'DKK',
        'GBP',
        'HUF',
        'PLN',
        'RON',
        'SEK',
        'CHF',
        'ISK',
        'NOK',
        'HRK',
        'RUB',
        'TRY',
        'AUD',
        'BRL',
        'CAD',
        'CNY',
        'HKD',
        'IDR',
        'ILS',
        'INR',
        'KRW',
        'MXN',
        'MYR',
        'NZD',
        'PHP',
        'SGD',
        'THB',
        'ZAR',
    ];

    /**
     * @var string
     */
    private $isoCode;

    public function __construct(string $isoCode)
    {
        $isoCode = strtoupper($isoCode);

        $this->ensureValidCurrency($isoCode);

        $this->isoCode = $isoCode;
    }

    /**
     * @param string $isoCode
     */
    private function ensureValidCurrency(string $isoCode)
    {
        if (! in_array($isoCode, self::VALID)) {
            throw new InvalidArgumentException('The currency '.$isoCode.' not is valid.');
        }
    }

    /**
     * @param Currency $isoCode
     *
     * @return bool
     */
    public function equals(Currency $isoCode)
    {
        return $this->isoCode() === $isoCode->isoCode();
    }

    /**
     * @return string
     */
    public function isoCode(): string
    {
        return $this->isoCode;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->isoCode();
    }
}