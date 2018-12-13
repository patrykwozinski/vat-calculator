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
    /** @var float */
    private $net;

    /** @var float */
    private $gross;

    /** @var float */
    private $tax;

    public function __construct(float $net, float $gross, float $tax)
    {
        $this->net = $net;
        $this->gross = $gross;
        $this->tax = $tax;
    }

    public function net(): float
    {
        return $this->net;
    }

    public function gross(): float
    {
        return $this->gross;
    }

    public function tax(): float
    {
        return $this->tax;
    }

    public function serialize(): string
    {
        $serialized = \json_encode([
            'net' => $this->net,
            'gross' => $this->gross,
            'tax' => $this->tax,
        ]);

        return false === $serialized ? '' : $serialized;
    }
}
