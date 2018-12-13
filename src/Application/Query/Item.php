<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 22:33
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Application\Query;


use Freeq\VatCalculator\Domain\Shared\ReadModelProjection;

final class Item
{
    /** @var ReadModelProjection */
    private $modelProjection;

    /** @var string */
    private $type;

    /** @var string */
    private $resource;

    public function __construct(ReadModelProjection $modelProjection)
    {
        $this->modelProjection = $modelProjection;
        $this->type = $this->classType($modelProjection);
        $this->resource = $modelProjection->serialize();
    }

    public function modelProjection(): ReadModelProjection
    {
        return $this->modelProjection;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function resource(): string
    {
        return $this->resource;
    }

    private function classType(ReadModelProjection $modelProjection): string
    {
        $path = \explode('\\', \get_class($modelProjection));

        return \array_pop($path) ?? '';
    }
}
