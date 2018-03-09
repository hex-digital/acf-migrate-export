<?php

namespace App\Models\FieldTypes;

use App\Models\AbstractField;

class Repeater extends AbstractField
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
        'collapsed'    => '',
        'min'          => '',
        'max'          => '',
        'layout'       => 'table',
        'button_label' => 'Add Row',
    ];

    /**
     * @return string
     */
    public function getType(): string
    {
        return 'repeater';
    }
}
