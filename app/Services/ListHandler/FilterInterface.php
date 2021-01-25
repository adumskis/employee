<?php

namespace App\Services\ListHandler;

use App\Services\RequestValidations\CustomValidationException;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Interface FilterInterface
 * @package App\Services\ListHandler
 */
interface FilterInterface
{
    /**
     * @param ParameterBag $bag
     * @param Builder $query
     * @throws CustomValidationException
     */
    public function filter(ParameterBag $bag, Builder $query): void;
}
