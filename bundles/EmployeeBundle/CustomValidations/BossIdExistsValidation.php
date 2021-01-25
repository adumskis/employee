<?php

namespace Bundles\EmployeeBundle\CustomValidations;

use App\Services\RequestValidations\CustomValidation;
use App\Services\RequestValidations\CustomValidationException;
use Bundles\EmployeeBundle\Models\Employee;
use Illuminate\Http\Request;

/**
 * Class BossIdExistsValidation
 * @package Bundles\EmployeeBundle\CustomValidations
 */
class BossIdExistsValidation implements CustomValidation
{
    /**
     * @var Employee
     */
    protected Employee $employeeQueryBuilder;

    /**
     * BossIdExistsValidation constructor.
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
        $bossId = $request->json('boss_id');

        if (!$bossId) {
            return;
        }

        $exists = $this->employeeQueryBuilder
            ->newQuery()
            ->where('id', $bossId)
            ->exists();

        if (!$exists) {
            throw new CustomValidationException('boss_id', 'Employee doesn\'t exist');
        }
    }
}
