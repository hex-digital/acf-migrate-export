<?php

namespace App\Parsers;

use App\Models\FieldGroup;
use App\Models\AbstractField;

class FieldGroupParser
{
    /**
     * Create a FieldGroup object from an Array of field group data.
     * This also turns all contained field data into AbstractField objects.
     * @param  array  $fieldGroupArray
     * @return FieldGroup
     */
    public function parseToFieldGroup(array $fieldGroupArray): FieldGroup
    {
        $key = $fieldGroupArray['key'];
        $title = $fieldGroupArray['title'];
        $fields = [];
        $options = [];

        return new FieldGroup($key, $title, $fields, $options);
    }
}
