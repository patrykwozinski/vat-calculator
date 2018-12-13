<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 01:53
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Domain\Price\Exception;


use Freeq\VatCalculator\Domain\Shared\Exception\RuntimeException;

final class NotCalculatedPrice extends RuntimeException
{
    public static function forOperation(string $operation): self
    {
        $message = \sprintf('Not calculated price for operation: %s', $operation);

        return new self($message);
    }
}
