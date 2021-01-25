<?php

namespace Bundles\EmployeeBundle\Services\ListHandler\Filters;

use App\Services\ListHandler\FilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class BossFilter
 * @package Bundles\EmployeeBundle\Services\ListHandler\Filters
 */
class BossFilter implements FilterInterface
{
    /**
     * @inheritDoc
     */
    public function filter(ParameterBag $bag, Builder $query): void
    {
        $bossId = $bag->get('boss_id');

        if ((int)$bossId) {
            $query->where('boss_id', $bossId);
        }
    }
}
