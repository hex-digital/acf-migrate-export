<?php

namespace App\Models\FieldTypes;

use App\Models\AbstractField;

class Select extends AbstractField
{
    const DEFAULT_OPTIONS = [
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => [
            'width' => '',
            'class' => '',
            'id' => '',
        ],
        'choices' => [],
        'default_value' => [],
        'allow_null' => 0,
        'multiple' => 0,
        'ui' => 0,
        'ajax' => 0,
        'placeholder' => '',
        'disabled' => 0,
        'readonly' => 0,
    ];

    /**
     * @return string
     */
    public function getType(): string
    {
        return 'select';
    }
}
