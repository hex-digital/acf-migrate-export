<?php

namespace App\Models\FieldTypes;

use App\Models\AbstractField;

class ColorPicker extends AbstractField
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
    ];
}
