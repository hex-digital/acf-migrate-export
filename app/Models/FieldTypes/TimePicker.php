<?php

namespace App\Models\FieldTypes;

use App\Models\AbstractField;

class TimePicker extends AbstractField
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
        'display_format' => 'g:i a',
        'return_format' => 'g:i a',
    ];

    /**
     * @return string
     */
    public function getType(): string
    {
        return 'time_picker';
    }
}
