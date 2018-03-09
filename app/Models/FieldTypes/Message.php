<?php

namespace App\Models\FieldTypes;

use App\Models\AbstractField;

class Message extends AbstractField
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
        'message' => '',
        'new_lines' => 'wpautop',
        'esc_html' => 0,
    ];
}
