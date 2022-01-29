<?php

namespace Ailequal\Plugins\Witte;

use Ailequal\Plugins\Witte\Commands\Exporter;
use Ailequal\Plugins\Witte\Commands\Gamma;
use Ailequal\Plugins\Witte\Commands\Importer;
use Ailequal\Plugins\Witte\Traits\Singleton;
use Exception;
use WP_CLI;

/**
 * The WP CLI plugin class.
 * Define all the plugin commands.
 */
class WpCli
{

    use Singleton;

    /**
     * Loads all the hooks related to this class.
     */
    public function hooks()
    {
        add_action('cli_init', [$this, 'register_commands']);
    }

    /**
     * Registers all the commands relative to the plugin.
     */
    public function register_commands()
    {
        try {
            WP_CLI::add_command('witte gamma', Gamma::class);
            WP_CLI::add_command('witte importer', Importer::class);
            WP_CLI::add_command('witte exporter', Exporter::class);
        } catch (Exception $e) {
            wp_die($e->getMessage());
        }
    }

}
