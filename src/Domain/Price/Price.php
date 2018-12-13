<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 01:37
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Domain\Price;


use Freeq\VatCalculator\Domain\Price\Exception\InvalidPriceArguments;
use Freeq\VatCalculator\Domain\Price\Exception\NotCalculatedPrice;
use Freeq\VatCalculator\Domain\TaxRule\TaxRule;

final class Price
{
    /** @var float|null */
    private $net;

    /** @var float|null */
    private $gross;

    /** @var float|null */
    private $tax;

    public function __construct(?float $net, ?float $gross)
    {
        if (null === $net && null === $gross)
        {
            throw InvalidPriceArguments::forAllMissing();
        }

        if (null !== $net && null !== $gross)
        {
            throw InvalidPriceArguments::forAllFilled();
        }

        $this->net = $net;
        $this->gross = $gross;
    }

    public function calculate(TaxRule $taxRule): void
    {
        $tax = 0;

        if (null === $this->net)
        {
            $tax = $this->gross * $taxRule->vatRate();

            $this->net = $this->gross - $tax;
        }
        elseif (null === $this->gross)
        {
            $tax = $this->net * $taxRule->vatRate();

            $this->gross = $this->net + $tax;
        }

        $this->tax = $tax;
    }

    public function net(): float
    {
        if (null === $this->net)
        {
            throw NotCalculatedPrice::forOperation('net');
        }

        return $this->net;
    }

    public function gross(): float
    {
        if (null === $this->gross)
        {
            throw NotCalculatedPrice::forOperation('gross');
        }

        return $this->gross;
    }

    public function tax(): float
    {
        if (null === $this->tax)
        {
            throw NotCalculatedPrice::forOperation('tax');
        }

        return $this->tax;
    }
}
