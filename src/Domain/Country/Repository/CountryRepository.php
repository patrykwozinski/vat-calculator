<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 03:04
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Domain\Country\Repository;


use Freeq\VatCalculator\Domain\Country\Country;

interface CountryRepository
{
    public function oneByIpAddress(string $ipAddress): Country;
}
