<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 22:33
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Application\Query;


final class Item
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function model()
    {
        return $this->model;
    }
}
