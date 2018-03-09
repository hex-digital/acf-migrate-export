<?php

namespace App\Models\FieldTypes;

use App\Models\AbstractField;

class Text extends AbstractField
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
        'maxlength'     => '',
        'readonly'      => 0,
        'disabled'      => 0,
    ];
}
