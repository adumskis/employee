<?php

namespace App\Http\Controllers;

use App\Resources\EmployeeResource;
use Exception;
use Illuminate\Http\Request;
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
            ->paginate();

        return EmployeeResource::collection($employees);
    }

    /**
     * @param int $id
     * @return JsonResource
     */
    public function show(int $id): JsonResource
    {
        $employee = $this->employeeQueryBuilder
            ->newQuery()
            ->with('boss')
            ->findOrFail($id);

        return EmployeeResource::make($employee);
    }

    /**
     * @param Request $request
     * @return JsonResource
     */
    public function store(Request $request): JsonResource
    {
        $employee = $this->employeeQueryBuilder
            ->newQuery()
            ->create($request->json()->all());

        return EmployeeResource::make($employee);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return JsonResource
     */
    public function update(int $id, Request $request): JsonResource
    {
        $employee = $this->employeeQueryBuilder
            ->newQuery()
            ->with('boss')
            ->findOrFail($id);

        $employee->update($request->json()->all());

        return EmployeeResource::make($employee);
    }

    /**
     * @param int $id
     * @return JsonResource
     * @throws Exception
     */
    public function remove(int $id): JsonResource
    {
        $employee = $this->employeeQueryBuilder
            ->newQuery()
            ->with('boss')
            ->findOrFail($id);

        $employee->delete();

        return EmployeeResource::make($employee);
    }
}
