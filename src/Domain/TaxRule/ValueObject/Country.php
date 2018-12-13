<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 01:44
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Domain\TaxRule\ValueObject;


final class Country
{
    /** @var string */
    private $fullName;

    /** @var string */
    private $prefix;

    public function __construct(string $fullName, string $prefix)
    {
        $this->fullName = $fullName;
        $this->prefix = $prefix;
    }

    public function fullName(): string
    {
        return $this->fullName;
    }

    public function prefix(): string
    {
        return $this->prefix;
    }
}
