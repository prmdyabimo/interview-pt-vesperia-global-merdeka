<?php

namespace App\Domain\Form\Entities;

class FormField
{
    public function __construct(
        public readonly string $id,
        public readonly string $label,
        public readonly string $type,
        public readonly ?string $subType,
        public readonly string $description,
        public readonly array $options,
        public readonly ?array $answer,
        public readonly string $parentId,
        public readonly string $ormOnly = 'no',
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'label' => $this->label,
            'type' => $this->type,
            'subType' => $this->subType,
            'description' => $this->description,
            'options' => $this->options,
            'answer' => $this->answer,
            'parentId' => $this->parentId,
            'ormOnly' => $this->ormOnly,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            label: $data['label'],
            type: $data['type'],
            subType: $data['subType'] ?? null,
            description: $data['description'],
            options: $data['options'] ?? [],
            answer: $data['answer'] ?? null,
            parentId: $data['parentId'],
            ormOnly: $data['ormOnly'] ?? 'no',
        );
    }
}

?>