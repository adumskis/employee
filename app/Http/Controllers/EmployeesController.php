<?php

namespace App\Http\Controllers;

use App\Http\Validators\EmployeeValidator;
use App\Resources\EmployeeResource;
use App\Services\RequestValidations\CustomValidationException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Employee;
use Illuminate\Validation\ValidationException;

/**
 * Class EmployeesController
 * @package App\Http\Controllers
 */
class EmployeesController extends Controller
{
    /**
     * @var Employee
     */
    protected Employee $employeeQueryBuilder;

    /**
     * @var EmployeeValidator
     */
    protected EmployeeValidator $employeeValidator;

    /**
     * EmployeesController constructor.
     * @param Employee $employeeQueryBuilder
     * @param EmployeeValidator $employeeValidator
     */
    public function __construct(Employee $employeeQueryBuilder, EmployeeValidator $employeeValidator)
    {
        $this->employeeQueryBuilder = $employeeQueryBuilder;
        $this->employeeValidator = $employeeValidator;
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
     * @throws CustomValidationException
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
     * @throws CustomValidationException
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
