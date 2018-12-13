<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 01:39
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Domain\TaxRule;


use Freeq\VatCalculator\Domain\Country\Country;

final class TaxRule
{
    /** @var Country */
    private $country;

    /** @var float */
    private $vatRate;

    /** @var array */
    private $exceptions;

    public function __construct(Country $country, float $vatRate, array $exceptions = [])
    {
        $this->country = $country;
        $this->vatRate = $vatRate;
        $this->exceptions = $exceptions;
    }

    public function country(): Country
    {
        return $this->country;
    }

    public function vatRate(): float
    {
        return $this->vatRate;
    }

    public function exceptions(): array
    {
        return $this->exceptions;
    }
}
