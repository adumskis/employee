<?php

namespace Bundles\EmployeeBundle\CustomValidations;

use Bundles\EmployeeBundle\Models\Employee;
use Bundles\EmployeeBundle\Models\Role;
use App\Services\RequestValidations\CustomValidation;
use App\Services\RequestValidations\CustomValidationException;
use Illuminate\Http\Request;

/**
 * Class OnlyOneCEOValidation
 * @package Bundles\EmployeeBundle\CustomValidations
 */
class OnlyOneCEOValidation implements CustomValidation
{
    /**
     * @var Employee
     */
    protected Employee $employeeQueryBuilder;

    /**
     * OnlyOneCEOValidation constructor.
     * @param Employee $employeeQueryBuilder
     */
    public function __construct(Employee $employeeQueryBuilder)
    {
        $this->employeeQueryBuilder = $employeeQueryBuilder;
    }

    /**
     * @inheritDoc
     */
    public function validateRequest(Request $request): void
    {
        if ($request->json('role') !== Role::NAME_CEO) {
            return;
        }

        $query = $this->employeeQueryBuilder
            ->newQuery()
            ->where('role', Role::NAME_CEO);

        if ($employeeId = $request->route('id')) {
            $query->where('id', '!=', $employeeId);
        }

        if ($query->exists()) {
            throw new CustomValidationException('role', 'Employee with role CEO already exists');
        }
    }
}
