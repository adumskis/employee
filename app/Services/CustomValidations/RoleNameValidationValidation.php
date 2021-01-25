<?php

namespace App\Services\CustomValidations;

use App\Models\Role;
use App\Services\RequestValidations\CustomValidation;
use App\Services\RequestValidations\CustomValidationException;
use Illuminate\Http\Request;

/**
 * Class RoleNameValidationValidation
 * @package App\Services\CustomValidations
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
