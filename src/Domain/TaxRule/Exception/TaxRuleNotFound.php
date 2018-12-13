<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 22:50
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Domain\TaxRule\Exception;


use Freeq\VatCalculator\Domain\Country\Country;
use Freeq\VatCalculator\Domain\Shared\Exception\RuntimeException;

final class TaxRuleNotFound extends RuntimeException
{
    public static function forCountry(Country $country): self
    {
        $message = \sprintf('Missing tax rule for country %s', $country->fullName());

        return new self($message);
    }
}
