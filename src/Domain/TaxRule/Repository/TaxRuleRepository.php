<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 01:40
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Domain\TaxRule\Repository;


use Freeq\VatCalculator\Domain\TaxRule\TaxRule;
use Freeq\VatCalculator\Domain\TaxRule\ValueObject\Country;

interface TaxRuleRepository
{
    public function oneByCountry(Country $country): TaxRule;
}
