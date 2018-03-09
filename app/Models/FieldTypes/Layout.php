<?php

namespace App\Models\FieldTypes;

use App\Models\AbstractField;

class Layout extends AbstractField
{
    const DEFAULT_OPTIONS = [
        'display' => 'block',
        'min'     => '',
        'max'     => '',
    ];
}
