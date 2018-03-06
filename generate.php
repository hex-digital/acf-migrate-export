<?php

require __DIR__ . '/vendor/autoload.php';

use App\MigrationGenerator;
use App\Models\Export;

$migrationGenerator = new MigrationGenerator();
$export = new Export();

$migrationGenerator->createMigrations($export);
