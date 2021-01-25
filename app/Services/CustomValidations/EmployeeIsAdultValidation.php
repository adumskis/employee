<?php

namespace App\Services\CustomValidations;

use App\Services\RequestValidations\CustomValidation;
use App\Services\RequestValidations\CustomValidationException;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class EmployeeIsAdultValidation
 * @package App\Services\CustomValidations
 */
class EmployeeIsAdultValidation implements CustomValidation
{
    const ADULT_AGE = 18;

    /**
     * @inheritDoc
     */
    public function validateRequest(Request $request): void
    {
        $birthDate = Carbon::parse($request->json('birth_date'));
        if ($birthDate->age < self::ADULT_AGE) {
            throw new CustomValidationException('birth_date', 'Employee must be at least 18 years old');
        }
    }
}
