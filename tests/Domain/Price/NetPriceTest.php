<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 01:31
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Tests\Domain\Price;


use Freeq\VatCalculator\Domain\Price\Exception\NotCalculatedNetPrice;
use Freeq\VatCalculator\Domain\Price\NetPrice;
use Freeq\VatCalculator\Domain\TaxRule\TaxRule;
use Freeq\VatCalculator\Domain\TaxRule\ValueObject\Country;
use Freeq\VatCalculator\Tests\Domain\DomainTestCase;

final class NetPriceTest extends DomainTestCase
{
    public function test_throws_not_calculated_when_fetching_gross(): void
    {
        $this->expectException(NotCalculatedNetPrice::class);

        $netPrice = new NetPrice(500);
        $netPrice->gross();
    }

    public function test_throws_not_calculated_when_fetching_tax(): void
    {
        $this->expectException(NotCalculatedNetPrice::class);

        $netPrice = new NetPrice(500);
        $netPrice->tax();
    }

    public function test_calculates_when_given_correct_tax(): void
    {
        $country = new Country('Poland', 'pl');
        $taxRule = new TaxRule($country, 0.23);

        $netPrice = new NetPrice(500);
        $netPrice->calculate($taxRule);

        $this->assertEquals(615, $netPrice->gross());
        $this->assertEquals(115, $netPrice->tax());
    }

    public function test_calculates_zeros_when_given_zero_tax_rate(): void
    {
        $country = new Country('Poland', 'pl');
        $taxRule = new TaxRule($country, 0);

        $netPrice = new NetPrice(500);
        $netPrice->calculate($taxRule);

        $this->assertEquals(500, $netPrice->gross());
        $this->assertEquals(0, $netPrice->tax());
    }
}
