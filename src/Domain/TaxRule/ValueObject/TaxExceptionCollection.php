<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 20:40
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Domain\TaxRule\ValueObject;


final class TaxExceptionCollection implements \IteratorAggregate
{
    /** @var TaxException[] */
    private $values;

    public function __construct(array $values)
    {
        $this->values = $values;
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->values);
    }
}
