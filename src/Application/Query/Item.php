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
    private $model;

    public function __construct(ReadModelProjection $model)
    {
        $this->model = $model;
    }

    public function model(): ReadModelProjection
    {
        return $this->model;
    }
}
