<?php

namespace Bundles\EmployeeBundle;

use Bundles\EmployeeBundle\CustomValidations\CEODontHaveBoseValidation;
use Bundles\EmployeeBundle\CustomValidations\EmployeeIsAdultValidation;
use Bundles\EmployeeBundle\CustomValidations\EmploymentDateIsNotFutureValidation;
use Bundles\EmployeeBundle\CustomValidations\FirstNameDifferentThenLastNameValidation;
use Bundles\EmployeeBundle\CustomValidations\OnlyOneCEOValidation;
use Bundles\EmployeeBundle\CustomValidations\RoleNameValidationValidation;
use Bundles\EmployeeBundle\Validators\EmployeeValidator;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application;

/**
 * Class EmployeeServiceProvider
 * @package Bundles\EmployeeBundle
 * @property Application $app
 */
class EmployeeServiceProvider extends ServiceProvider
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

        $this->registerRoutes();
    }

    /**
     * @return void
     */
    protected function registerRoutes(): void
    {
        $this->app->router->group([
            'namespace' => 'Bundles\EmployeeBundle\Controllers',
            'prefix' => 'api',
        ], function ($router) {
            require __DIR__ . '/routes/api.php';
        });
    }
}
