<?php

namespace App\Services\CustomValidations;

use App\Models\Role;
use App\Services\RequestValidations\CustomValidation;
use App\Services\RequestValidations\CustomValidationException;
use Illuminate\Http\Request;

/**
 * Class CEODontHaveBoseValidation
 * @package App\Services\CustomValidations
 */
class CEODontHaveBoseValidation implements CustomValidation
{
    /**
     * @inheritDoc
     */
    public function validateRequest(Request $request): void
    {
        if ($request->json('role') !== Role::NAME_CEO) {
            return;
        }

        if (!is_null($request->json('boss_id'))) {
            throw new CustomValidationException('boss_id', 'CEO can\'t have a boss');
        }
    }
}
