<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 03:38
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Domain\TaxRule\ValueObject;


final class TaxException
{
    /** @var string */
    private $region;

    /** @var float */
    private $vatRate;

    public function __construct(string $region, float $vatRate)
    {
        $this->region = $region;
        $this->vatRate = $vatRate;
    }

    public function region(): string
    {
        return $this->region;
    }

    public function vatRate(): float
    {
        return $this->vatRate;
    }
}
