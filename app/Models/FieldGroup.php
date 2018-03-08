<?php

namespace App\Models;

class FieldGroup
{
    /** @var string */
    protected $key;

    /** @var string */
    protected $title;

    /** @var array */
    protected $fields;

    /** @var array */
    protected $options;

    const DEFAULT_OPTIONS = [];

    /**
     * @param ?string $key
     * @param string $title
     * @param array  $fields
     * @param array  $options
     */
    public function __construct(
        ?string $key,
        string $title,
        array $fields,
        array $options
    ) {
        $this->key = $key;
        $this->title = $title;
        $this->fields = $fields;
        $this->options = $options;
    }

    /**
     * @return ?string
     */
    public function getKey(): ?string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @param AbstractField $field
     */
    public function addField(AbstractField $field): void
    {
        $this->fields[] = $field;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function addOption(string $name, $value): void
    {
        $this->options[$name] = $value;
    }
}
