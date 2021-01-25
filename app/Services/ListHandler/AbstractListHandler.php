<?php

namespace App\Services\ListHandler;

use App\Services\RequestValidations\CustomValidationException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class AbstractListHandler
 * @package App\Services\ListHandler
 */
abstract class AbstractListHandler
{
    /**
     * @var FilterInterface[]
     */
    protected array $filters = [];

    /**
     * @param FilterInterface $filter
     */
    public function addFilter(FilterInterface $filter): void
    {
        $this->filters[] = $filter;
    }

    /**
     * @param ParameterBag $bag
     * @return LengthAwarePaginator
     * @throws ValidationException
     */
    public function getList(ParameterBag $bag): LengthAwarePaginator
    {
        $query = $this->getBasicQuery();

        $errorMessages = [];
        foreach ($this->filters as $filter) {
            try {
                $filter->filter($bag, $query);
            } catch (CustomValidationException $exception) {
                $errorMessages[$exception->getKey()][] = $exception->getMessage();
            }
        }

        if ($errorMessages) {
            throw ValidationException::withMessages($errorMessages);
        }

        return $query->paginate();
    }

    /**
     * @return Builder
     */
    abstract protected function getBasicQuery(): Builder;
}
