<?php

namespace App\Domain\Form\Entities;

use Illuminate\Support\Collection;

class FormData
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly Collection $fields,
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'payloads' => $this->fields->map(fn(FormField $field) => $field->toArray())->toArray(),
        ];
    }

    public static function fromArray(array $data): self
    {
        $fields = collect($data['payloads'] ?? [])
            ->map(fn(array $fieldData) => $fieldData);
            // ->map(fn(array $fieldData) => FormField::fromArray($fieldData));

        return new self(
            id: $data['id'],
            name: $data['name'],
            fields: $fields
        );
    }
}

?>