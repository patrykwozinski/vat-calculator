<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 02:53
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Domain\TaxRule\ValueObject;


final class PostalCode
{
    /** @var string */
    private $postalCode;

    public function __construct(string $postalCode)
    {
        $this->postalCode = $postalCode;
    }

    public function postalCode(): string
    {
        return $this->postalCode;
    }
}
