<?php

namespace App\Services\RequestValidations;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

/**
 * Class AbstractValidator
 * @package App\Services\RequestValidations
 */
abstract class AbstractValidator
{
    use ProvidesConvenienceMethods {
        validate as validateRequest;
    }

    /**
     * @var CustomValidation[]
     */
    protected array $customValidations = [];

    /**
     * @param CustomValidation $customValidation
     */
    public function addCustomValidation(CustomValidation $customValidation): void
    {
        $this->customValidations[] = $customValidation;
    }

    /**
     * @param Request $request
     * @return array
     */
    abstract protected function basicValidations(Request $request): array;

    /**
     * @param Request $request
     * @throws ValidationException
     */
    public function validate(Request $request): void
    {
        $this->validateRequest($request, $this->basicValidations($request));

        $validationMessages = [];
        foreach ($this->customValidations as $customValidation) {
            try {
                $customValidation->validateRequest($request);
            } catch (CustomValidationException $exception) {
                $validationMessages[$exception->getKey()][] = $exception->getMessage();
            }
        }

        if ($validationMessages) {
            throw ValidationException::withMessages($validationMessages);
        }
    }
}
