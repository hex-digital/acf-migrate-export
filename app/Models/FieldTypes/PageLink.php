<?php

namespace App\Models\FieldTypes;

use App\Models\AbstractField;

class PageLink extends AbstractField
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
        'post_type'  => [],
        'taxonomy'   => [],
        'allow_null' => 0,
        'multiple'   => 0,
    ];
}
