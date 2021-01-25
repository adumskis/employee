<?php

namespace Bundles\EmployeeBundle\CustomValidations;

use App\Services\RequestValidations\CustomValidation;
use App\Services\RequestValidations\CustomValidationException;
use Illuminate\Http\Request;

/**
 * Class FirstNameDifferentThenLastNameValidation
 * @package Bundles\EmployeeBundle\CustomValidations
 */
class FirstNameDifferentThenLastNameValidation implements CustomValidation
{
    /**
     * @inheritDoc
     */
    public function validateRequest(Request $request): void
    {
        if ($request->json('first_name') == $request->json('last_name')) {
            throw new CustomValidationException('first_name', 'First name can\'t be the same as last name');
        }
    }
}
