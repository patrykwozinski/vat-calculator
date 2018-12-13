<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 23:07
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Tests\Application\Query\PriceNet;


use Freeq\VatCalculator\Application\Query\Item;
use Freeq\VatCalculator\Application\Query\PriceNet\PriceNetByIpAddressQuery;
use Freeq\VatCalculator\Application\Query\PriceNet\PriceNetByIpAddressQueryHandler;
use Freeq\VatCalculator\Application\Query\QueryHandler;
use Freeq\VatCalculator\Domain\Country\Country;
use Freeq\VatCalculator\Domain\Country\Exception\CountryNotFound;
use Freeq\VatCalculator\Domain\Country\Repository\CountryRepository;
use Freeq\VatCalculator\Domain\Price\Factory\PriceFactory;
use Freeq\VatCalculator\Domain\Price\Projection\PriceView;
use Freeq\VatCalculator\Domain\TaxRule\Exception\TaxRuleNotFound;
use Freeq\VatCalculator\Domain\TaxRule\Repository\TaxRuleRepository;
use Freeq\VatCalculator\Domain\TaxRule\TaxRule;
use Freeq\VatCalculator\Tests\Application\ApplicationTestCase;

final class PriceNetByIpAddressQueryHandlerTest extends ApplicationTestCase
{
    /** @var QueryHandler */
    private $queryHandler;

    public function setUp(): void
    {
        $countryRepository = new class() implements CountryRepository {
            public function oneByIpAddress(string $ipAddress): Country
            {
                if ('1.1.1.1' === $ipAddress)
                {
                    return new Country('Internet', 'E');
                }

                if ('2.2.2.2' === $ipAddress)
                {
                    return new Country('Nibylandia', 'NB');
                }

                throw CountryNotFound::forIp($ipAddress);
            }
        };

        $taxRuleRepository = new class() implements TaxRuleRepository {
            public function oneByCountry(Country $country): TaxRule
            {
                if ('NB' === $country->prefix())
                {
                    return new TaxRule($country, 0.66);
                }

                throw TaxRuleNotFound::forCountry($country);
            }
        };

        $this->queryHandler = new PriceNetByIpAddressQueryHandler($countryRepository, $taxRuleRepository, new PriceFactory());
    }

    public function test_throws_country_not_found_when_incorrect_ip_address(): void
    {
        $this->expectException(CountryNotFound::class);

        $this->queryHandler->handle(new PriceNetByIpAddressQuery('0.0.0.0', 5.5));
    }

    public function test_throws_tax_rule_not_found_when_missing_tax_rule_for_country(): void
    {
        $this->expectException(TaxRuleNotFound::class);

        $this->queryHandler->handle(new PriceNetByIpAddressQuery('1.1.1.1', 7.77));
    }

    public function test_returns_item_with_calculated_when_country_and_tax_exists(): void
    {
        /** @var Item $result */
        $result = $this->queryHandler->handle(new PriceNetByIpAddressQuery('2.2.2.2', 50.60));

        /** @var PriceView $priceView */
        $priceView = $result->modelProjection();

        $this->assertInstanceOf(Item::class, $result);
        $this->assertInstanceOf(PriceView::class, $priceView);
        $this->assertEquals($priceView->net(), 50.60);
        $this->assertEquals($priceView->gross(), 84.00);
        $this->assertEquals($priceView->tax(), 33.40);
    }
}
