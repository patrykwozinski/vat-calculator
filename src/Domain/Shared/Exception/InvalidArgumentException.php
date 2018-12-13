<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 02:42
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Domain\Shared\Exception;


class InvalidArgumentException extends \InvalidArgumentException implements DomainException
{
}
