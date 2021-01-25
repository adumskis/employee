<?php

namespace App\Providers;

use App\Http\Validators\EmployeeValidator;
use App\Services\CustomValidations\CEODontHaveBoseValidation;
use App\Services\CustomValidations\EmployeeIsAdultValidation;
use App\Services\CustomValidations\EmploymentDateIsNotFutureValidation;
use App\Services\CustomValidations\FirstNameDifferentThenLastNameValidation;
use App\Services\CustomValidations\OnlyOneCEOValidation;
use App\Services\CustomValidations\RoleNameValidationValidation;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->resolving(EmployeeValidator::class, function (EmployeeValidator $validator) {
            $validator->addCustomValidation($this->app->make(CEODontHaveBoseValidation::class));
            $validator->addCustomValidation($this->app->make(EmployeeIsAdultValidation::class));
            $validator->addCustomValidation($this->app->make(EmploymentDateIsNotFutureValidation::class));
            $validator->addCustomValidation($this->app->make(FirstNameDifferentThenLastNameValidation::class));
            $validator->addCustomValidation($this->app->make(OnlyOneCEOValidation::class));
            $validator->addCustomValidation($this->app->make(RoleNameValidationValidation::class));
        });
    }
}
