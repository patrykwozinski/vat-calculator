<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 22:45
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Application\Query\Price;


use Freeq\VatCalculator\Application\Query\Item;
use Freeq\VatCalculator\Application\Query\Query;
use Freeq\VatCalculator\Application\Query\QueryHandler;
use Freeq\VatCalculator\Domain\Country\Repository\CountryRepository;
use Freeq\VatCalculator\Domain\Price\Factory\PriceFactory;
use Freeq\VatCalculator\Domain\Price\Projection\PriceView;
use Freeq\VatCalculator\Domain\TaxRule\Repository\TaxRuleRepository;

final class PriceNetByIpAddressQueryHandler implements QueryHandler
{
    /** @var CountryRepository */
    private $countryRepository;

    /** @var TaxRuleRepository */
    private $taxRuleRepository;

    /** @var PriceFactory */
    private $priceFactory;

    public function __construct(CountryRepository $countryRepository, TaxRuleRepository $taxRuleRepository, PriceFactory $priceFactory)
    {
        $this->countryRepository = $countryRepository;
        $this->taxRuleRepository = $taxRuleRepository;
        $this->priceFactory      = $priceFactory;
    }

    /**
     * @param PriceNetByIpAddressQuery | Query $query
     *
     * @return Item
     */
    public function handle(Query $query): Item
    {
        $country = $this->countryRepository->oneByIpAddress($query->ipAddress());
        $taxRule = $this->taxRuleRepository->oneByCountry($country);

        $price = $this->priceFactory->createNet($query->price());
        $price->calculate($taxRule);

        $priceView = new PriceView($price->net(), $price->gross(), $price->tax());

        return new Item($priceView);
    }
}
