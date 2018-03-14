<?php

namespace App\Models\FieldTypes;

use App\Models\AbstractField;

class Wysiwyg extends AbstractField
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
        'tabs'          => 'all',
        'toolbar'       => 'full',
        'media_upload'  => 1,
    ];

    /**
     * @return string
     */
    public function getType(): string
    {
        return 'wysiwyg';
    }
}