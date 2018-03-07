<?php

/**
 * This script is used to generate a migrations file from an ACF PHP export,
 * for example the one generated in the backend of WordPress, within ACF plugin.
 *
 * php generate.php -f <filePath> [-a | if absolute path]
 *
 * This will take all the FieldGroups defined in the export, load them into an
 * export varaible, and then use this export variable to generate a migrations
 * file that can be used with acf-migrations.
 * (github.com/hex-digital/acf-migrations)
 *
 * The end goal is to be able to take Custom Fields defined in the WordPress
 * backend of ACF, and move them to a migrations.php file, which means that
 * the ACF fields now live in version control, with all the benefits that
 * provides.
 */
require __DIR__.'/vendor/autoload.php';

use App\MigrationGenerator;
use App\Models\Export;
use App\Parsers;

// We use a global variable because the export file calls the function
// `acf_add_local_field_group()`. This way, we can use this to add the field
// groups to $export without having to edit the export file in any way.
global $export;

$migrationGenerator = new MigrationGenerator();
$export = new Export();

// -f: The file path of the export to migrate
// -a: If the specified file path is absolute, this flag should be added
$options = getopt('f:a');

if (!isset($options['f'])) {
    Helpers\ConsoleOutput::write(
        'Please specify a file path to an export file with the -f flag',
        Helpers\ConsoleOutput::ERROR
    );
    die();
}

$exportFilePath = $options['f'];
if (!isset($options['a'])) {
    $exportFilePath = __DIR__.'/'.$exportFilePath;
}

if (!file_exists($exportFilePath)) {
    Helpers\ConsoleOutput::write(
        'Could not locate file '.$exportFilePath.'. Add flag -a if using an absolute path',
        Helpers\ConsoleOutput::ERROR
    );
    die();
}

// This file is from the ACF export, and calls the `acf_add_local_field_group`
// function for each field group. We capture this with a helper function below
include $exportFilePath;

// Now everything will be in $export, so we can generate our migrations file
// $migrationGenerator->createMigrations($export);

/* Helper Functions for the ACF Export */

/**
 * Used to add a Field Group to the global export, so that a migration file can
 * be generated from it.
 *
 * @param array $fieldGroupArray Array of Field Groups from ACF export
 *
 * @return void
 */
function addFieldGroupToExport(array $fieldGroupArray): void
{
    global $export;

    $fieldGroupParser = new Parsers\FieldGroupParser();
    $fieldGroup = $fieldGroupParser->parse($fieldGroupArray);

    // $export->addFieldGroup($fieldGroup);
}

/**
 * Helper function - this is the function that the exported code from ACF calls
 * for each Field Group. By using this helper function, we can simply plug the
 * PHP ACF export straight into this code without having to modify it at all.
 * This function simply passes along the fieldGroupArray to the real function.
 *
 * @param array $fieldGroupArray Array of Field Groups from ACF export
 *
 * @return void
 */
function acf_add_local_field_group(array $fieldGroupArray): void
{
    addFieldGroupToExport($fieldGroupArray);
}
