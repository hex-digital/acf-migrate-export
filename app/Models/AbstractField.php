<?php

namespace App\Models;

use Helpers\TextManipulation;

abstract class AbstractField
{
    /** @var string */
    protected $key;

    /** @var string */
    protected $label;

    /** @var array */
    protected $subFields;

    /** @var array */
    protected $options;

    const DEFAULT_OPTIONS = [];

    /**
     * @param ?string $key
     * @param string  $label
     * @param string  $type
     * @param array   $sub_fields
     * @param array   $options
     *
     * @throws UnexpectedValueException if unsupported field type passed
     */
    public static function createField(
        ?string $key = null,
        string $label,
        string $type,
        array $subFields = [],
        array $options = []
    ): self {
        $fieldClassName = __NAMESPACE__.'\\FieldTypes\\'.TextManipulation::slugToClassName($type);

        if (!class_exists($fieldClassName)) {
            throw new \UnexpectedValueException('Field type '.$type.' is currently unsupported. No Class '.$fieldClassName);
        }

        return new $fieldClassName($key, $label, $subFields, $options);
    }

    /**
     * @param ?string $key
     * @param string  $label
     * @param string  $type
     * @param array   $sub_fields
     * @param array   $options
     */
    public function __construct(
        ?string $key = null,
        string $label,
        array $subFields = [],
        array $options = []
    ) {
        $this->key = $key;
        $this->label = $label;
        $this->subFields = $subFields;
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
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return array
     */
    public function getSubFields(): array
    {
        return $this->subFields;
    }

    /**
     * @param AbstractField $field
     */
    public function addSubField(self $field): void
    {
        $this->subFields[] = $field;
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
     * @param mixed  $value
     */
    public function addOption(string $name, $value): void
    {
        $this->options[$name] = $value;
    }

    /**
     * Return the options, stripping out those where both the key and value
     * match a set in the default options for this field.
     *
     * @return array
     */
    public function getOptionsWithoutDefaults(): array
    {
        $defaultOptions = static::DEFAULT_OPTIONS;

        return array_filter($this->options, function ($value, $key) use ($defaultOptions) {
            return !isset($defaultOptions[$key]) || $defaultOptions[$key] !== $value;
        }, ARRAY_FILTER_USE_BOTH);
    }

    /**
     * @return string
     */
    abstract public function getType(): string;
}
