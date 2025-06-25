<?php

namespace App\Domain\Form\Repositories;

use App\Domain\Form\Entities\FormData;

interface FormRepositoryInterface
{
    // Get all forms
    public function getAllForms(): array;

    // Get form data by type
    public function getFormDataByType(string $type): ?FormData;

    // Save form submission
    public function saveFormSubmission(string $formId, string $formType, array $values): bool;

    // Get all submissions by type
    public function getFormSubmissions(int $limit = 10, int $offset = 0): array;
}

?>