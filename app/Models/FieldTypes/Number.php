<?php

namespace App\Models\FieldTypes;

use App\Models\AbstractField;

class Number extends AbstractField
{
    const DEFAULT_OPTIONS = [
        'instructions'      => '',
        'required'          => 0,
        'conditional_logic' => 0,
        'wrapper'           => [
            'width' => '',
            'class' => '',
            'id'    => '',
        ],
        'default_value' => '',
        'placeholder'   => '',
        'prepend'       => '',
        'append'        => '',
        'min'           => '',
        'max'           => '',
        'step'          => '',
        'readonly'      => 0,
        'disabled'      => 0,
    ];

    /**
     * @return string
     */
    public function getType(): string
    {
        return 'number';
    }
}
