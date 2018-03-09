<?php

namespace App\Models\FieldTypes;

use App\Models\AbstractField;

class Taxonomy extends AbstractField
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
        'taxonomy'      => 'category',
        'field_type'    => 'checkbox',
        'allow_null'    => 0,
        'add_term'      => 1,
        'save_terms'    => 0,
        'load_terms'    => 0,
        'return_format' => 'id',
        'multiple'      => 0,
    ];

    /**
     * @return string
     */
    public function getType(): string
    {
        return 'taxonomy';
    }
}
