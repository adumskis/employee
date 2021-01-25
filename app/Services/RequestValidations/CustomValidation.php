<?php

namespace App\Services\RequestValidations;

use Illuminate\Http\Request;

/**
 * Interface CustomValidation
 * @package Bundles\EmployeeBundle\CustomValidations
 */
interface CustomValidation
{
    /**
     * @param Request $request
     * @throws CustomValidationException
     */
    public function validateRequest(Request $request): void;
}
