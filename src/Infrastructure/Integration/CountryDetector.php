<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 03:05
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Infrastructure\Integration;


use Freeq\VatCalculator\Domain\Country\Country;
use Freeq\VatCalculator\Domain\Country\Exception\CountryNotFound;
use Freeq\VatCalculator\Domain\Country\Repository\CountryRepository;

final class CountryDetector implements CountryRepository
{
    private const DELIMITER = ';';
    private const RESERVED_PREFIX = 'ZZ';
    private const PREFIX_POSITION = 1;
    private const FULL_NAME_POSITION = 3;

    /** @var string */
    private $geocoderUrl;

    public function __construct(string $geocoderUrl)
    {
        $this->geocoderUrl = $geocoderUrl;
    }

    public function oneByIpAddress(string $ipAddress): Country
    {
        $url    = $this->geocoderUrl . $ipAddress;
        $result = \file_get_contents($url);

        if (false === $result)
        {
            throw CountryNotFound::forIp($ipAddress);
        }

        $countryInfo = \explode(self::DELIMITER, $result);

        if (self::RESERVED_PREFIX === $countryInfo[self::PREFIX_POSITION])
        {
            throw CountryNotFound::forIp($ipAddress);
        }

        return new Country($countryInfo[self::FULL_NAME_POSITION], $countryInfo[self::PREFIX_POSITION]);
    }
}
