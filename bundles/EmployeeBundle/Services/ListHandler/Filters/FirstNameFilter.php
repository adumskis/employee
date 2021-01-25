<?php

namespace Bundles\EmployeeBundle\Services\ListHandler\Filters;

use App\Services\ListHandler\FilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class NameFilter
 * @package Bundles\EmployeeBundle\Services\ListHandler\Filters
 */
class FirstNameFilter implements FilterInterface
{
    /**
     * @inheritDoc
     */
    public function filter(ParameterBag $bag, Builder $query): void
    {
        $firstName = $bag->get('first_name');

        if ((string)$firstName) {
            $query->where('first_name', 'like',  '%' . $firstName . '%');
        }
    }
}
