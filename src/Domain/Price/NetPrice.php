<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 01:37
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Domain\Price;


use Freeq\VatCalculator\Domain\Price\Exception\NotCalculatedNetPrice;
use Freeq\VatCalculator\Domain\TaxRule\TaxRule;

final class NetPrice
{
    /** @var float */
    private $net;

    /** @var float|null */
    private $gross;

    /** @var float|null */
    private $tax;

    public function __construct(float $net)
    {
        $this->net = $net;
    }

    public function calculate(TaxRule $taxRule): void
    {
        $tax = $this->net * $taxRule->vatRate();

        $this->gross = $this->net + $tax;
        $this->tax = $tax;
    }

    public function gross(): float
    {
        if (null === $this->gross)
        {
            throw NotCalculatedNetPrice::forOperation('gross');
        }

        return $this->gross;
    }

    public function tax(): float
    {
        if (null === $this->tax)
        {
            throw NotCalculatedNetPrice::forOperation('tax');
        }

        return $this->tax;
    }
}
