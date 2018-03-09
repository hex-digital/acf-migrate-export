<?php

namespace App\Models\FieldTypes;

use App\Models\AbstractField;

class FlexibleContent extends AbstractField
{
    const DEFAULT_OPTIONS = [
        'instructions'      => '',
        'required'          => '',
        'conditional_logic' => '',
        'wrapper'           => [
            'width' => '',
            'class' => '',
            'id'    => '',
        ],
        'button_label' => 'Add Row',
        'min'          => '',
        'max'          => '',
    ];

    /**
     * @return string
     */
    public function getType(): string
    {
        return 'flexible_content';
    }
}
