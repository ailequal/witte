<?php

namespace Ailequal\Plugins\Witte\Commands;

use Ailequal\Plugins\Witte\Abstracts\Hook;
use Ailequal\Plugins\Witte\Traits\Singleton;
use Exception;
use WP_CLI;

/**
 * The Exporter plugin class.
 * Define the WP CLI exporter functionality.
 */
class Exporter extends Hook
{

    use Singleton;

    /**
     * Loads all the hooks related to this class.
     */
    public function hooks()
    {
        add_action('cli_init', [$this, 'registerCommands'], 10, 1);
    }

    /**
     * Registers all the commands relative to the plugin.
     */
    public function registerCommands()
    {
        try {
            WP_CLI::add_command('witte exporter', [$this, 'init']);
        } catch (Exception $e) {
            wp_die($e->getMessage());
        }
    }

    /**
     * Initialize the command.
     * Handles the plugin data export.
     *
     * "wp witte exporter"
     *
     * @param  array  $args
     * @param  array  $assocArgs
     */
    public function init($args, $assocArgs)
    {
        // TODO: Write the Exporter class.
        var_dump($args);
        echo "\n";
        var_dump($assocArgs);

        WP_CLI::success(__('Finished exporting data.', 'witte'));
    }

}
