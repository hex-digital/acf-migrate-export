<?php

namespace App\Models\FieldTypes;

use App\Models\AbstractField;

class TextArea extends AbstractField
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
        'maxlength'     => '',
        'rows'          => '',
        'new_lines'     => 'wpautop',
        'readonly'      => 0,
        'disabled'      => 0,
    ];

    /**
     * @return string
     */
    public function getType(): string
    {
        return 'textarea';
    }
}
