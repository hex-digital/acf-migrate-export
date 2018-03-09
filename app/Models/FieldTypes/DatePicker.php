<?php

namespace App\Models\FieldTypes;

use App\Models\AbstractField;

class DatePicker extends AbstractField
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
        'display_format' => 'd/m/Y',
        'return_format'  => 'd/m/Y',
        'first_day'      => 1,
    ];

    /**
     * @return string
     */
    public function getType(): string
    {
        return 'date_picker';
    }
}
