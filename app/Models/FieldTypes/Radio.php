<?php

namespace App\Models\FieldTypes;

use App\Models\AbstractField;

class Radio extends AbstractField
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
        'choices'           => [],
        'allow_null'        => 0,
        'other_choice'      => 0,
        'save_other_choice' => 0,
        'default_value'     => '',
        'layout'            => 'vertical',
    ];

    /**
     * @return string
     */
    public function getType(): string
    {
        return 'radio';
    }
}
