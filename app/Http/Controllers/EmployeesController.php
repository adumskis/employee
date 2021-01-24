<?php

namespace App\Http\Controllers;

use App\Resources\EmployeeResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Employee;

/**
 * Class EmployeesController
 * @package App\Http\Controllers
 */
class EmployeesController
{
    /**
     * @var Employee
     */
    protected Employee $employeeQueryBuilder;

    /**
     * EmployeesController constructor.
     * @param Employee $employeeQueryBuilder
     */
    public function __construct(Employee $employeeQueryBuilder)
    {
        $this->employeeQueryBuilder = $employeeQueryBuilder;
    }

    /**
     * @return JsonResource
     */
    public function index(): JsonResource
    {
        $employees = $this->employeeQueryBuilder
            ->newQuery()
            ->with('boss')
            ->get();

        return EmployeeResource::collection($employees);
    }
}
