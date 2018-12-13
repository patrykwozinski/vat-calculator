<?php
/**
 * Created by PhpStorm.
 * User: freeq
 * Date: 13/12/2018
 * Time: 22:45
 */
declare(strict_types=1);

namespace Freeq\VatCalculator\Application\Query\Price;


use Freeq\VatCalculator\Application\Query\Item;
use Freeq\VatCalculator\Application\Query\Query;
use Freeq\VatCalculator\Application\Query\QueryHandler;

final class PriceNetByIpAddressQueryHandler implements QueryHandler
{
    /**
     * @param PriceNetByIpAddressQuery | Query $query
     *
     * @return Item
     */
    public function handle(Query $query): Item
    {
        // TODO: Implement handle() method.
    }
}
