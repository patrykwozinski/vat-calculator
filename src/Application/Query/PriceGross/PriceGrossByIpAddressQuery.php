<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 23:41
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Application\Query\PriceGross;


use Freeq\VatCalculator\Application\Query\Query;

final class PriceGrossByIpAddressQuery implements Query
{
    /** @var string */
    private $ipAddress;

    /** @var float */
    private $price;

    public function __construct(string $ipAddress, float $price)
    {
        $this->ipAddress = $ipAddress;
        $this->price = $price;
    }

    public function ipAddress(): string
    {
        return $this->ipAddress;
    }

    public function price(): float
    {
        return $this->price;
    }
}
