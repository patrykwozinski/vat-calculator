<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 23:00
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Tests\Domain\Price;


use Freeq\VatCalculator\Domain\Price\Exception\NotCalculatedPrice;
use Freeq\VatCalculator\Domain\Price\Factory\PriceFactory;
use Freeq\VatCalculator\Tests\Domain\DomainTestCase;

final class PriceFactoryTest extends DomainTestCase
{
    public function test_creates_price_net_when_create_net(): void
    {
        $priceFactory = new PriceFactory();
        $price = $priceFactory->createNet(55.50);

        $this->assertEquals(55.50, $price->net());
    }

    public function test_creates_price_gross_when_create_gross(): void
    {
        $priceFactory = new PriceFactory();
        $price = $priceFactory->createGross(6.00);

        $this->assertEquals(6.00, $price->gross());
    }

    public function test_throws_invalid_not_calculated_when_create_net_and_fetch_gross(): void
    {
        $this->expectException(NotCalculatedPrice::class);

        $priceFactory = new PriceFactory();
        $price = $priceFactory->createNet(5.55);

        $price->gross();
    }

    public function test_throws_invalid_not_calculated_when_create_gross_and_fetch_net(): void
    {
        $this->expectException(NotCalculatedPrice::class);

        $priceFactory = new PriceFactory();
        $price = $priceFactory->createGross(5.55);

        $price->net();
    }
}
