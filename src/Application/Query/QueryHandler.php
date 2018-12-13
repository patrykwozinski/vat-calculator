<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 22:32
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Application\Query;


interface QueryHandler
{
    public function handle(Query $query);
}
