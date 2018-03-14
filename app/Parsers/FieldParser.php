<?php

namespace App\Parsers;

use App\Models\AbstractField;

class FieldParser implements ParserInterface
{
    const NON_OPTION_FIELDS = ['key', 'label', 'type', 'sub_fields', 'layouts'];

    /**
     * Create a Field object from an Array of field data.
     *
     * @param array $fieldArray
     *
     * @return Field
     */
    public function parse(array $fieldArray): AbstractField
    {
        $key = $this->extractKey($fieldArray);
        $label = $this->extractLabel($fieldArray);
        $type = $this->extractType($fieldArray);
        $subFields = $this->extractSubFields($fieldArray);
        $options = $this->extractOptions($fieldArray);

        // TODO: Reconsider this to make it more Object Oriented
        // Consider making FieldParser abstract, and then make one for sub_fields
        // and one for layouts.
        // Then split the functions called above (remove type) and called Layout::createField
        // instead for the layout one
        if ($type === 'flexible_content') {
            $subFields = $this->extractLayouts($fieldArray);
        }

        return AbstractField::createField($key, $label, $type, $subFields, $options);
    }

    /**
     * Extract the key field value from a field array.
     *
     * @param array $fieldArray
     *
     * @return string
     */
    protected function extractKey(array $fieldArray): ?string
    {
        if (isset($fieldArray['key']) && strlen($fieldArray['key']) > 0) {
            return $fieldArray['key'];
        }

        return null;
    }

    /**
     * Extract the label field value from a field array.
     *
     * @param array $fieldArray
     *
     * @throws OutOfBoundsException if no label key is set in field array
     *
     * @return string
     */
    protected function extractLabel(array $fieldArray): string
    {
        if (!isset($fieldArray['label'])) {
            throw new \OutOfBoundsException('A \'label\' could not be found for a Field');
        }

        return $fieldArray['label'];
    }

    /**
     * Extract the type field value from a field array.
     *
     * @param array $fieldArray
     *
     * @throws OutOfBoundsException if no type key is set in field array
     *
     * @return string
     */
    protected function extractType(array $fieldArray): string
    {
        if (!isset($fieldArray['type'])) {
            throw new \OutOfBoundsException('A \'type\' could not be found for a Field');
        }

        return $fieldArray['type'];
    }

    /**
     * Extract the subfields from a field array.
     *
     * @param array $fieldArray
     *
     * @return array
     */
    protected function extractSubFields(array $fieldArray): ?array
    {
        if (isset($fieldArray['sub_fields']) && count($fieldArray['sub_fields']) > 0) {
            $fields = [];

            foreach ($fieldArray['sub_fields'] as $subFieldArray) {
                $fields[] = $this->parse($subFieldArray);
            }

            return $fields;
        }

        return [];
    }

    /**
     * Extract the layouts from a field array.
     *
     * @param array $fieldArray
     *
     * @return array
     */
    protected function extractLayouts(array $fieldArray): ?array
    {
        if (isset($fieldArray['layouts']) && count($fieldArray['layouts']) > 0) {
            $fields = [];

            foreach ($fieldArray['layouts'] as $layoutArray) {
                $fields[] = $this->parse($layoutArray);
            }

            return $fields;
        }

        return [];
    }

    /**
     * Extract the options from a field array.
     *
     * @param array $fieldArray
     *
     * @return array
     */
    protected function extractOptions(array $fieldArray): array
    {
        $options = [];

        foreach ($fieldArray as $key => $value) {
            if (!in_array($key, $this::NON_OPTION_FIELDS)) {
                $options[$key] = $value;
            }
        }

        return $options;
    }
}
