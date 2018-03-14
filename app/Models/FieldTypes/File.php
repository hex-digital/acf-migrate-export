<?php

namespace App\Models\FieldTypes;

use App\Models\AbstractField;

class File extends AbstractField
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
        'return_format' => 'array',
        'library'       => 'all',
        'min_size'      => '',
        'max_size'      => '',
        'mime_types'    => '',
    ];

    /**
     * @return string
     */
    public function getType(): string
    {
        return 'file';
    }
}
