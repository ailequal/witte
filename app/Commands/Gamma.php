<?php

namespace Ailequal\Plugins\Witte\Commands;

use Ailequal\Plugins\Witte\Abstracts\Hook;
use Ailequal\Plugins\Witte\Controllers\Alpha;
use Ailequal\Plugins\Witte\Traits\DependencyInjection;
use Ailequal\Plugins\Witte\Traits\Singleton;
use Exception;
use WP_CLI;

/**
 * The Gamma plugin class.
 * Define the WP CLI gamma functionality.
 *
 * All the dependencies injected as magic methods:
 * @property Alpha $alpha
 */
class Gamma extends Hook
{

    use Singleton;
    use DependencyInjection;

    /**
     * Loads all the hooks related to this class.
     */
    public function hooks()
    {
        add_action('cli_init', [$this, 'registerCommands']);
    }

    /**
     * Registers all the commands relative to the plugin.
     */
    public function registerCommands()
    {
        try {
            WP_CLI::add_command('witte gamma', [$this, 'init']);
        } catch (Exception $e) {
            wp_die($e->getMessage());
        }
    }

    /**
     * Initialize the command.
     * Greets the user.
     *
     * "wp witte gamma"
     * "wp witte hi"
     *
     * @alias hi
     *
     * @param  array  $args
     * @param  array  $assocArgs
     */
    public function init($args, $assocArgs)
    {
        var_dump($args);
        echo "\n";
        var_dump($assocArgs);

        WP_CLI::log(Alpha::getInstance()->alpha());

        WP_CLI::success('Hello world user.');
    }

}
