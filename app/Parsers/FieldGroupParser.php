<?php

namespace App\Parsers;

use App\Models\AbstractField;
use App\Models\FieldGroup;

class FieldGroupParser implements ParserInterface
{
    const NON_OPTION_FIELDS = ['key', 'title', 'fields'];

    /**
     * Create a FieldGroup object from an Array of field group data.
     * This also turns all contained field data into AbstractField objects.
     *
     * @param array $fieldGroupArray
     *
     * @return FieldGroup
     */
    public function parse(array $fieldGroupArray): FieldGroup
    {
        $key = $this->extractKey($fieldGroupArray);
        $title = $this->extractTitle($fieldGroupArray);
        $fields = $this->extractFields($fieldGroupArray);
        $options = $this->extractOptions($fieldGroupArray);

        return new FieldGroup($key, $title, $fields, $options);
    }

    /**
     * Extract the key field value from a field group array
     *
     * @param array $fieldGroupArray
     *
     * @return string
     */
    protected function extractKey(array $fieldGroupArray): string
    {
        return $fieldGroupArray['key'];
    }

    /**
     * Extract the title field value from a field group array
     *
     * @param array $fieldGroupArray
     *
     * @return string
     */
    protected function extractTitle(array $fieldGroupArray): string
    {
        return $fieldGroupArray['title'];
    }

    /**
     * Extract the fields from a field group array
     *
     * @param array $fieldGroupArray
     *
     * @return array
     */
    protected function extractFields(array $fieldGroupArray): array
    {
        return [];
    }

    /**
     * Extract the options from a field group array
     *
     * @param array $fieldGroupArray
     *
     * @return array
     */
    protected function extractOptions(array $fieldGroupArray): array
    {
        $options = [];

        foreach ($fieldGroupArray as $key => $value) {
            if (!in_array($key, $this::NON_OPTION_FIELDS)) {
                $options[$key] = $value;
            }
        }

        return $options;
    }
}
