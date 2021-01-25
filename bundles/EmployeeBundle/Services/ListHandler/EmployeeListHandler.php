<?php

namespace Bundles\EmployeeBundle\Services\ListHandler;

use App\Services\ListHandler\AbstractListHandler;
use Bundles\EmployeeBundle\Models\Employee;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class EmployeeListHandler
 * @package Bundles\EmployeeBundle\Services\ListHandler
 */
class EmployeeListHandler extends AbstractListHandler
{
    /**
     * @var Employee
     */
    protected Employee $employeeQueryBuilder;

    /**
     * EmployeeListHandler constructor.
     * @param Employee $employeeQueryBuilder
     */
    public function __construct(Employee $employeeQueryBuilder)
    {
        $this->employeeQueryBuilder = $employeeQueryBuilder;
    }

    /**
     * @return Builder|Employee
     */
    protected function getBasicQuery(): Builder
    {
        return $this->employeeQueryBuilder->newQuery()->with('boss');
    }
}
