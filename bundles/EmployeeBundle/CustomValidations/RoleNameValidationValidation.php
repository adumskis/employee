<?php

namespace Bundles\EmployeeBundle\CustomValidations;

use Bundles\EmployeeBundle\Models\Role;
use App\Services\RequestValidations\CustomValidation;
use App\Services\RequestValidations\CustomValidationException;
use Illuminate\Http\Request;

/**
 * Class RoleNameValidationValidation
 * @package Bundles\EmployeeBundle\CustomValidations
 */
class RoleNameValidationValidation implements CustomValidation
{
    /**
     * @inheritDoc
     */
    public function validateRequest(Request $request): void
    {
        if (!in_array($request->json('role'), Role::NAMES_LIST)) {
            throw new CustomValidationException('role', 'Role doesn\'t exist');
        }
    }
}
