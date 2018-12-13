<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 02:42
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Domain\Price\Exception;


use Freeq\VatCalculator\Domain\Shared\Exception\InvalidArgumentException;

final class InvalidPriceArguments extends InvalidArgumentException
{
    public static function forAllMissing(): self
    {
        $message = \sprintf('Incorrect arguments for price (only nulls).');

        return new self($message);
    }

    public static function forAllFilled(): self
    {
        $message = \sprintf('Incorrect arguments for price (anyone is null).');

        return new self($message);
    }
}
