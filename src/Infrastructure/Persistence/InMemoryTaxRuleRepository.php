<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 22:07
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Infrastructure\Persistence;


use Freeq\VatCalculator\Domain\Country\Country;
use Freeq\VatCalculator\Domain\TaxRule\Exception\TaxRuleNotFound;
use Freeq\VatCalculator\Domain\TaxRule\Repository\TaxRuleRepository;
use Freeq\VatCalculator\Domain\TaxRule\TaxRule;
use Freeq\VatCalculator\Domain\TaxRule\ValueObject\TaxException;
use Freeq\VatCalculator\Domain\TaxRule\ValueObject\TaxExceptionCollection;

final class InMemoryTaxRuleRepository implements TaxRuleRepository
{
    private $taxRules = [
        'AT' => [ // Austria
            'rate'       => 0.20,
            'exceptions' => [
                'Jungholz'   => 0.19,
                'Mittelberg' => 0.19,
            ],
        ],
        'BE' => [ // Belgium
            'rate' => 0.21,
        ],
        'BG' => [ // Bulgaria
            'rate' => 0.20,
        ],
        'CY' => [ // Cyprus
            'rate' => 0.19,
        ],
        'CZ' => [ // Czech Republic
            'rate' => 0.21,
        ],
        'DE' => [ // Germany
            'rate'       => 0.19,
            'exceptions' => [
                'Heligoland'            => 0,
                'Büsingen am Hochrhein' => 0,
            ],
        ],
        'DK' => [ // Denmark
            'rate' => 0.25,
        ],
        'EE' => [ // Estonia
            'rate' => 0.20,
        ],
        'EL' => [ // Hellenic Republic (Greece)
            'rate'       => 0.24,
            'exceptions' => [
                'Mount Athos' => 0,
            ],
        ],
        'ES' => [ // Spain
            'rate'       => 0.21,
            'exceptions' => [
                'Canary Islands' => 0,
                'Ceuta'          => 0,
                'Melilla'        => 0,
            ],
        ],
        'FI' => [ // Finland
            'rate' => 0.24,
        ],
        'FR' => [ // France
            'rate' => 0.20,
        ],
        'GB' => [ // United Kingdom
            'rate'       => 0.20,
            'exceptions' => [
                // UK RAF Bases in Cyprus are taxed at Cyprus rate
                'Akrotiri' => 0.19,
                'Dhekelia' => 0.19,
            ],
        ],
        'GR' => [ // Greece
            'rate'       => 0.24,
            'exceptions' => [
                'Mount Athos' => 0,
            ],
        ],
        'HR' => [ // Croatia
            'rate' => 0.25,
        ],
        'HU' => [ // Hungary
            'rate' => 0.27,
        ],
        'IE' => [ // Ireland
            'rate' => 0.23,
        ],
        'IT' => [ // Italy
            'rate'       => 0.22,
            'exceptions' => [
                'Campione d\'Italia' => 0,
                'Livigno'            => 0,
            ],
        ],
        'LT' => [ // Lithuania
            'rate' => 0.21,
        ],
        'LU' => [ // Luxembourg
            'rate' => 0.17,
        ],
        'LV' => [ // Latvia
            'rate' => 0.21,
        ],
        'MT' => [ // Malta
            'rate' => 0.18,
        ],
        'NL' => [ // Netherlands
            'rate' => 0.21,
            'rates' => [
                'high' => 0.21,
                'low' => 0.06,
            ],
        ],
        'PL' => [ // Poland
            'rate' => 0.23,
        ],
        'PT' => [ // Portugal
            'rate'       => 0.23,
            'exceptions' => [
                'Azores'  => 0.18,
                'Madeira' => 0.22,
            ],
        ],
        'RO' => [ // Romania
            'rate' => 0.19,
        ],
        'SE' => [ // Sweden
            'rate' => 0.25,
        ],
        'SI' => [ // Slovenia
            'rate' => 0.22,
        ],
        'SK' => [ // Slovakia
            'rate' => 0.20,
        ],
        // Countries associated with EU countries that have a special VAT rate
        'MC' => [ // Monaco France
            'rate' => 0.20,
        ],
        'IM' => [ // Isle of Man - United Kingdom
            'rate' => 0.20,
        ],
        // Non-EU with their own VAT requirements
        'NO' => [ // Norway
            'rate' => 0.25,
        ],
    ];

    public function oneByCountry(Country $country): TaxRule
    {
        $taxRule = $this->taxRules[$country->prefix()] ?? null;

        if (null === $taxRule)
        {
            throw TaxRuleNotFound::forCountry($country);
        }

        $ruleExceptions = $taxRule['exceptions'] ?? [];
        $exceptions = [];

        if (false === empty($ruleExceptions))
        {
            foreach ($ruleExceptions as $region => $vatRate)
            {
                $exceptions[] = new TaxException($region, $vatRate);
            }
        }

        $exceptions = new TaxExceptionCollection($exceptions);

        return new TaxRule($country, $taxRule['rate'], $exceptions);
    }
}
