<?php

namespace Ailequal\Plugins\Witte\Utilities;

use Ailequal\Plugins\Witte\Traits\Singleton;

/**
 * The Log plugin class.
 * Logs any data into the plugin logs folder.
 */
class Log
{

    // TODO: Add a user interface for downloading or deleting the logs?

    use Singleton;

    /**
     * Writes the passed data (array with key value pairs format)
     * into a log file stored (by default) in the plugin logs folder.
     *
     * @param  array  $data
     * @param  string  $basePath
     */
    public function log($data, $basePath = WITTE_BASE_PATH)
    {
        if (false === is_array($data) || true === empty($data))
            return;

        // By default it's gonna be the plugin base path.
        // Another useful base path to use could be the current active theme,
        // set it by calling "get_stylesheet_directory() . '/'".
        if (false === is_string($basePath) || true === empty($basePath))
            return;

        // All the logs will be stored inside the relative folder.
        $check = wp_mkdir_p($basePath.'logs');
        if (false == $check)
            return;

        $time      = time();
        $date      = date('Y-m-d H:i:s', $time).' UTC'."\n";
        $data      = json_encode($data, JSON_PRETTY_PRINT);
        $formatter = "\n\n========================================================================================\n\n";
        $path      = $basePath.'logs/'.getmypid().'.log'; // Each process has its own log file.

        // These lines will avoid logging twice the data in the file.
        // @link https://stackoverflow.com/questions/9001911/why-are-php-errors-printed-twice
        ini_set('log_errors', 1);
        ini_set('display_errors', 0);

        // Message type 3 will log into a file.
        error_log($date.$data.$formatter, 3, $path);
    }

}
