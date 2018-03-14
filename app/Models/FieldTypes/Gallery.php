<?php

namespace App\Models\FieldTypes;

use App\Models\AbstractField;

class Gallery extends AbstractField
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
        'min'          => '',
        'max'          => '',
        'preview_size' => 'thumbnail',
        'insert'       => 'append',
        'library'      => 'all',
        'min_width'    => '',
        'min_height'   => '',
        'min_size'     => '',
        'max_width'    => '',
        'max_height'   => '',
        'max_size'     => '',
        'mime_types'   => '',
    ];

    /**
     * @return string
     */
    public function getType(): string
    {
        return 'gallery';
    }
}
