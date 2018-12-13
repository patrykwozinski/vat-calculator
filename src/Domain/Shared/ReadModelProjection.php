<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 22:41
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Domain\Shared;


interface ReadModelProjection
{
    public function serialize(): string;
}
