<?php

namespace App\Models\FieldTypes;

use App\Models\AbstractField;

class DateTimePicker extends AbstractField
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
        'display_format' => 'd/m/Y g:i a',
        'return_format'  => 'd/m/Y g:i a',
        'first_day'      => 1,
    ];
}
