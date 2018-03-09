<?php

namespace Helpers;

class ConsoleOutput
{
    const ERROR = 'error';
    const WARN = 'warning';
    const SUCCESS = 'success';

    const COLOR_ERROR = "\033[1;31m";
    const COLOR_WARN = "\033[1;33m";
    const COLOR_SUCCESS = "\033[1;32m";
    const COLOR_RESET = "\033[0m";

    /**
     * Stylise and output a message to the console.
     * Specifying a type adds a prefix and colour.
     *
     * @param string      $message
     * @param string|null $type    Optional type - use constant from self:
     *                             ::ERROR, ::WARN or ::SUCCESS
     */
    public static function write(string $message, $type = null)
    {
        $output = '--> ';

        if ($type !== null) {
            switch ($type) {
                case self::ERROR:
                    $textPrefix = self::COLOR_ERROR.'Error: ';
                    break;
                case self::SUCCESS:
                    $textPrefix = self::COLOR_SUCCESS.'Success: ';
                    break;
                case self::WARN:
                default:
                    $textPrefix = self::COLOR_WARN.'Warning: ';
                    break;
            }
            $output .= $textPrefix.self::COLOR_RESET;
        }

        $output .= $message;

        echo $output.PHP_EOL;
    }
}
