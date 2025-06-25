<?php

namespace App\Domain\Form\Services;

use App\Domain\Form\Entities\FormData;
use App\Domain\Form\Repositories\FormRepositoryInterface;
use App\Domain\Shared\Exceptions\FormNotFoundException;
use App\Domain\Shared\Exceptions\InvalidFormDataException;

class FormService
{
    public function __construct(
        private readonly FormRepositoryInterface $formRepository
    ) {
    }

    public function getForms(): array
    {
        $forms = $this->formRepository->getAllForms();

        if (empty($forms)) {
            throw new FormNotFoundException('No forms found');
        }

        return $forms;
    }

    public function getFormByType(string $formType): FormData
    {
        $formData = $this->formRepository->getFormDataByType($formType);

        if (!$formData) {
            throw new FormNotFoundException("Form with type {$formType} not found");
        }

        return $formData;
    }

    public function submitForm(string $formType, array $values): array
    {
        $formData = $this->getFormByType($formType);

        $this->validateFormData($formData, $values);

        $success = $this->formRepository->saveFormSubmission(
            formId: $formData->id,
            formType: $formType,
            values: $values
        );

        if (!$success) {
            throw new \RuntimeException("Failed to save form submission for type {$formType}");
        }

        return [
            'success' => true,
            'message' => 'Form berhasil disimpan',
            'form_id' => $formData->id,
            'form_type' => $formType
        ];
    }

    public function getFormSubmissions(int $page = 1, int $perPage = 10): array
    {
        $offset = ($page - 1) * $perPage;

        return $this->formRepository->getFormSubmissions(
            limit: $perPage,
            offset: $offset
        );
    }

    private function validateFormData(FormData $formStructure, array $formValues): void
    {
        $errors = [];

        foreach ($formStructure->fields as $field) {
            $fieldId = $field['id'] ?? null;
            $fieldType = $field['type'] ?? null;
            $fieldLabel = $field['label'] ?? 'Field';

            $fieldValue = $formValues[$fieldId] ?? null;

            if ($this->isFieldEmpty($fieldValue, $fieldType)) {
                $errors[$fieldId] = "{$fieldLabel} wajib diisi";
                continue;
            }

            $this->validateFieldType($field, $fieldValue, $errors);
        }

        if (!empty($errors)) {
            throw new InvalidFormDataException('Validation failed', $errors);
        }
    }

    private function isFieldEmpty($value, string $type): bool
    {
        if ($value === null || $value === '') {
            return true;
        }

        if (in_array($type, ['radio_button', 'checkbox']) && is_array($value) && empty($value)) {
            return true;
        }

        return false;
    }

    private function validateFieldType($field, $value, array &$errors): void
    {
        $label = $field['label'] ?? 'Field';

        switch ($field['type']) {
            case 'text':
                if ($field['sub_type'] === 'amount' && !is_numeric(str_replace(['.', ','], '', $value))) {
                    $errors[$field['id']] = "{$label} harus berupa angka";
                }
                break;

            case 'radio_button':
                if (!is_array($value) || count($value) !== 1) {
                    $errors[$field['id']] = "{$label} harus memilih satu opsi";
                }
                break;

            case 'checkbox':
                if (!is_array($value)) {
                    $errors[$field['id']] = "{$label} harus berupa array";
                }
                break;
        }
    }
}

?>