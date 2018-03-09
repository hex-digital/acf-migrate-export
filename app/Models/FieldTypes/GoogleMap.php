<?php

namespace App\Models\FieldTypes;

use App\Models\AbstractField;

class GoogleMap extends AbstractField
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
        'center_lat' => '',
        'center_lng' => '',
        'zoom' => '',
        'height' => '',
    ];

    /**
     * @return string
     */
    public function getType(): string
    {
        return 'google_map';
    }
}
