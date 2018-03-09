<?php

namespace Helpers;

class TextManipulation
{
    /**
     * Takes some slug and formats it into a correct Classname
     * e.g. date_time_picker -> DateTimePicker
     *
     * @param  stirng $slug
     *
     * @return string
     */
    public static function slugToClassName(string $slug) {
        $output = str_replace( ['-', '_'], ' ', $slug );
        $output = ucwords($output);
        $output = str_replace( ' ', '', $output );
        return $output;
    }
}
