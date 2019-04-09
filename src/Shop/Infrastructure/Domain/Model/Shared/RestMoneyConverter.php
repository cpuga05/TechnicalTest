<?php

declare(strict_types = 1);

namespace Shop\Infrastructure\Domain\Model\Shared;

use InvalidArgumentException;
use Shop\Domain\Model\Shared\Currency;
use Shop\Domain\Model\Shared\Money;
use Shop\Domain\Model\Shared\MoneyConverter;

final class RestMoneyConverter implements MoneyConverter
{
    private const URI = 'http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml';

    /**
     * @param Money    $money
     * @param Currency $currency
     *
     * @return Money
     */
    public function convert(Money $money, Currency $currency): Money
    {
        $xml = simplexml_load_file(self::URI);

        foreach ($xml->Cube->Cube->Cube as $rate) {
            if (((string)$rate['currency']) === $currency->isoCode()) {
                return new Money($money->amount() * ((float)$rate['rate']), new Currency((string)$rate['currency']));
            }
        }

        throw new InvalidArgumentException('Not currency found.');
    }
}