<?php

namespace App\Models\FieldTypes;

use App\Models\AbstractField;

class Tab extends AbstractField
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
        'placement' => 'top',
        'endpoint'  => 0,
    ];

    /**
     * @return string
     */
    public function getType(): string
    {
        return 'tab';
    }
}