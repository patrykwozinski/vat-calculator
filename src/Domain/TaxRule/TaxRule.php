<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 01:39
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Domain\TaxRule;


use Freeq\VatCalculator\Domain\TaxRule\ValueObject\Country;

final class TaxRule
{
    /** @var Country */
    private $country;

    /** @var float */
    private $vatRate;

    public function __construct(Country $country, float $vatRate)
    {
        $this->country = $country;
        $this->vatRate = $vatRate;
    }

    public function country(): Country
    {
        return $this->country;
    }

    public function vatRate(): float
    {
        return $this->vatRate;
    }
}
