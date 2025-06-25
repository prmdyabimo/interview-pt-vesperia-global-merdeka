<?php

namespace App\Domain\Shared\Exceptions;

use Exception;

class FormNotFoundException extends Exception
{
    public function __construct(string $message = "Form not found")
    {
        parent::__construct($message, 404);
    }
}

class InvalidFormDataException extends Exception
{
    public function __construct(
        string $message = "Invalid form data",
        public readonly array $errors = []
    ) {
        parent::__construct($message, 422);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}

?>