<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 22:40
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Domain\Price\Projection;


use Freeq\VatCalculator\Domain\Shared\ReadModelProjection;

final class PriceView implements ReadModelProjection
{
    public function __construct()
    {
    }

    public function serialize(): array
    {
        // TODO: Implement serialize() method.
    }
}
