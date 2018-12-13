<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 22:53
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Domain\Price\Factory;


use Freeq\VatCalculator\Domain\Price\Price;

final class PriceFactory
{
    public function createNet(float $net): Price
    {
        return new Price($net, null);
    }

    public function createGross(float $gross): Price
    {
        return new Price(null, $gross);
    }
}
