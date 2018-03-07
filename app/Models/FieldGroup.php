<?php

namespace App\Models;

class FieldGroup
{
    protected $key;
    protected $title;
    protected $fields;
    protected $options;

    const DEFAULT_OPTIONS = [];

    public function __construct(
        string $key,
        string $title,
        array $fields,
        array $options
    ) {
        $this->key = $key;
        $this->title = $title;
        $this->fields = $fields;
        $this->options = $options;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function addField(AbstractField $field): void
    {
        $this->fields[] = $field;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function addOption(string $key, $value): void
    {
        $this->options[$key] = $value;
    }
}
