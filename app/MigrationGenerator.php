<?php

namespace App;

use App\Models\Export;

class MigrationGenerator
{
    /**
     * Create an ACF migrations file from an Export object
     *
     * @param  Export $export
     *
     * @return string A string of PHP migrations
     */
    public function createMigrations(Export $export): string
    {
        return '';
    }
}
