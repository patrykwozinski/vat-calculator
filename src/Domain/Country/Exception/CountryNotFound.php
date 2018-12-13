<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 03:19
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Domain\Country\Exception;


use Freeq\VatCalculator\Domain\Shared\Exception\RuntimeException;

final class CountryNotFound extends RuntimeException
{
    public static function forIp(string $ipAddress): self
    {
        $message = \sprintf('Cannot find country for IP address: %s', $ipAddress);

        return new self($message);
    }
}
