<?php

namespace App\Services\RequestValidations;

use Exception;

/**
 * Class CustomValidationException
 * @package App\Services\CustomValidations
 */
class CustomValidationException extends Exception
{
    /**
     * @var string
     */
    protected string $key;

    /**
     * CustomValidationException constructor.
     * @param string $key
     * @param string $message
     */
    public function __construct(string $key, string $message)
    {
        $this->key = $key;
        parent::__construct($message, 422);
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }
}
