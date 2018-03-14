<?php

namespace App\Models\FieldTypes;

use App\Models\AbstractField;

class Oembed extends AbstractField
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
        'width'  => '',
        'height' => '',
    ];

    /**
     * @return string
     */
    public function getType(): string
    {
        return 'oembed';
    }
}
