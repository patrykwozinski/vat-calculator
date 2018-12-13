<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 01:31
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Tests\Domain\Price;


use Freeq\VatCalculator\Domain\Price\Exception\InvalidPriceArguments;
use Freeq\VatCalculator\Domain\Price\Exception\NotCalculatedPrice;
use Freeq\VatCalculator\Domain\Price\Price;
use Freeq\VatCalculator\Domain\TaxRule\TaxRule;
use Freeq\VatCalculator\Domain\TaxRule\ValueObject\Country;
use Freeq\VatCalculator\Tests\Domain\DomainTestCase;

final class PriceTest extends DomainTestCase
{
    public function test_throws_invalid_price_arguments_when_passing_nulls(): void
    {
        $this->expectException(InvalidPriceArguments::class);

        new Price(null, null);
    }

    public function test_throws_invalid_price_arguments_when_all_filled(): void
    {
        $this->expectException(InvalidPriceArguments::class);

        new Price(1.1, 2.2);
    }

    public function test_throws_not_calculated_when_fetching_gross(): void
    {
        $this->expectException(NotCalculatedPrice::class);

        $netPrice = new Price(500.0, null);
        $netPrice->gross();
    }

    public function test_throws_not_calculated_when_fetching_tax(): void
    {
        $this->expectException(NotCalculatedPrice::class);

        $netPrice = new Price(500.0, null);
        $netPrice->tax();
    }

    public function test_calculates_gross_when_given_correct_tax(): void
    {
        $country = new Country('Poland', 'pl');
        $taxRule = new TaxRule($country, 0.23);

        $netPrice = new Price(500.0, null);
        $netPrice->calculate($taxRule);

        $this->assertEquals(615, $netPrice->gross());
        $this->assertEquals(115, $netPrice->tax());
    }

    public function test_calculates_net_when_given_correct_tax(): void
    {
        $country = new Country('Poland', 'pl');
        $taxRule = new TaxRule($country, 0.23);

        $grossPrice = new Price(null, 500.0);
        $grossPrice->calculate($taxRule);

        $this->assertEquals(385, $grossPrice->net());
        $this->assertEquals(115, $grossPrice->tax());
    }

    public function test_calculates_zeros_when_given_zero_tax_rate(): void
    {
        $country = new Country('Poland', 'pl');
        $taxRule = new TaxRule($country, 0);

        $netPrice = new Price(500.0, null);
        $netPrice->calculate($taxRule);

        $this->assertEquals(500, $netPrice->gross());
        $this->assertEquals(500, $netPrice->net());
        $this->assertEquals(0, $netPrice->tax());
    }
}
