<?php

namespace Bundles\EmployeeBundle\Controllers;

use Bundles\EmployeeBundle\Services\ListHandler\EmployeeListHandler;
use Bundles\EmployeeBundle\Validators\EmployeeValidator;
use App\Resources\EmployeeResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Bundles\EmployeeBundle\Models\Employee;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;

/**
 * Class EmployeesController
 * @package Bundles\EmployeeBundle\Controllers
 */
class EmployeesController extends Controller
{
    /**
     * @var Employee
     */
    protected Employee $employeeQueryBuilder;

    /**
     * @var EmployeeListHandler
     */
    protected EmployeeListHandler $employeeListHandler;

    /**
     * @var EmployeeValidator
     */
    protected EmployeeValidator $employeeValidator;

    /**
     * EmployeesController constructor.
     * @param Employee $employeeQueryBuilder
     * @param EmployeeListHandler $employeeListHandler
     * @param EmployeeValidator $employeeValidator
     */
    public function __construct(Employee $employeeQueryBuilder, EmployeeListHandler $employeeListHandler, EmployeeValidator $employeeValidator)
    {
        $this->employeeQueryBuilder = $employeeQueryBuilder;
        $this->employeeListHandler = $employeeListHandler;
        $this->employeeValidator = $employeeValidator;
    }

    /**
     * @param Request $request
     * @return JsonResource
     * @throws ValidationException
     */
    public function index(Request $request): JsonResource
    {
        $employees = $this->employeeListHandler->getList($request->query);

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
     * @throws ValidationException
     */
    public function store(Request $request): JsonResource
    {
        $this->employeeValidator->validate($request);

        $employee = $this->employeeQueryBuilder
            ->newQuery()
            ->create($request->json()->all());

        return EmployeeResource::make($employee);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return JsonResource
     * @throws ValidationException
     */
    public function update(int $id, Request $request): JsonResource
    {
        $this->employeeValidator->validate($request);

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
