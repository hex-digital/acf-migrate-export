<?php

namespace App\Models\FieldTypes;

use App\Models\AbstractField;

class Password extends AbstractField
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
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'readonly' => 0,
        'disabled' => 0,
    ];
}
