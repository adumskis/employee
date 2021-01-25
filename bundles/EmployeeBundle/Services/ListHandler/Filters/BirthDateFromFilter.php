<?php

namespace Bundles\EmployeeBundle\Services\ListHandler\Filters;

use App\Services\ListHandler\FilterInterface;
use App\Services\RequestValidations\CustomValidationException;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class BirthDateFilter
 * @package Bundles\EmployeeBundle\Services\ListHandler\Filters
 */
class BirthDateFromFilter implements FilterInterface
{
    const FILTER_KEY = 'birth_date_from';

    /**
     * @inheritDoc
     */
    public function filter(ParameterBag $bag, Builder $query): void
    {
        if (!$bag->has(self::FILTER_KEY)) {
            return;
        }

        try {
            $from = Carbon::parse($bag->get(self::FILTER_KEY));
        } catch (InvalidFormatException $exception) {
            throw new CustomValidationException(self::FILTER_KEY, 'Invalid date format');
        }

        $query->whereDate('birth_date', '>=', $from);
    }
}
