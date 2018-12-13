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
use Freeq\VatCalculator\Domain\TaxRule\ValueObject\TaxExceptionCollection;

final class TaxRule
{
    /** @var Country */
    private $country;

    /** @var float */
    private $vatRate;

    /** @var TaxExceptionCollection */
    private $exceptions;

    public function __construct(Country $country, float $vatRate, TaxExceptionCollection $exceptions = null)
    {
        $this->country = $country;
        $this->vatRate = $vatRate;
        $this->exceptions = $exceptions ?? new TaxExceptionCollection([]);
    }

    public function country(): Country
    {
        return $this->country;
    }

    public function vatRate(): float
    {
        return $this->vatRate;
    }

    public function exceptions(): TaxExceptionCollection
    {
        return $this->exceptions;
    }
}
