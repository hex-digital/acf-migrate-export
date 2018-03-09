<?php

namespace App\Models\FieldTypes;

use App\Models\AbstractField;

class User extends AbstractField
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
        'role' => '',
        'allow_null' => 0,
        'multiple' => 0,
    ];

    /**
     * @return string
     */
    public function getType(): string
    {
        return 'user';
    }
}
