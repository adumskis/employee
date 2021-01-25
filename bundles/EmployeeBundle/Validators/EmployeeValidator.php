<?php

namespace Bundles\EmployeeBundle\Validators;

use App\Services\RequestValidations\AbstractValidator;
use Illuminate\Http\Request;

/**
 * Class EmployeeValidator
 * @package Bundles\EmployeeBundle\Validators
 */
class EmployeeValidator extends AbstractValidator
{
    /**
     * @inheritDoc
     */
    protected function basicValidations(Request $request): array
    {
        return [
            'first_name' => 'required|min:1|max:50',
            'last_name' => 'required|min:1|max:50',
            'birth_date' => 'required|date',
            'employment_date' => 'required|date',
            'home_address' => 'required|min:1|max:100',
            'boss_id' => 'present',
            'role' => 'required',
        ];
    }
}
