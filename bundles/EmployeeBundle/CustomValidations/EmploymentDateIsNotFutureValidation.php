<?php

namespace Bundles\EmployeeBundle\CustomValidations;

use App\Services\RequestValidations\CustomValidation;
use App\Services\RequestValidations\CustomValidationException;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class EmploymentDateIsNotFutureValidation
 * @package Bundles\EmployeeBundle\CustomValidations
 */
class EmploymentDateIsNotFutureValidation implements CustomValidation
{
    /**
     * @inheritDoc
     */
    public function validateRequest(Request $request): void
    {
        $employmentDate = Carbon::parse($request->json('employment_date'));
        if ($employmentDate->isFuture()) {
            throw new CustomValidationException('employment_date', 'Employment date can\'t be a future date');
        }
    }
}
