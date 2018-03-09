<?php

namespace App\Models\FieldTypes;

use App\Models\AbstractField;

class Relationship extends AbstractField
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
        'post_type' => [],
        'taxonomy' => [],
        'filters' => [
            0 => 'search',
            1 => 'post_type',
            2 => 'taxonomy',
        ],
        'elements' => '',
        'min' => '',
        'max' => '',
        'return_format' => 'object',
    ];
}
