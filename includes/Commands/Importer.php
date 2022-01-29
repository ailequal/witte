<?php

namespace Ailequal\Plugins\Witte\Commands;

use Ailequal\Plugins\Witte\Traits\DependencyInjection;
use WP_CLI;

/**
 * The Importer plugin class.
 * Define the WP CLI importer functionality.
 */
class Importer
{

    use DependencyInjection;

    /**
     * The constructor function.
     */
    public function __construct()
    {
        $this->injectDependencies();
    }

    /**
     * Inject all needed object instances as dependencies.
     * The dependencies are injected through this method,
     * since we can't apply the singleton trait to any WP CLI class.
     */
    protected function injectDependencies() { }

    /**
     * Inject an object instance as a dependency.
     * The first argument will let you choose a custom name for calling it.
     * Override the visibility of this function (inherited from the trait)
     * from "public" to "protected", to avoid end user from executing it
     * from the WP CLI.
     *
     * @param  string  $key  The name of the property injected.
     * @param  mixed  $dependency  The dependency instance.
     */
    protected function injectDependency($key, $dependency)
    {
        $this->dependencies[$key] = $dependency;
    }

    /**
     * 'wp witte importer run'
     *
     * Start the importer.
     *
     * @param $args
     * @param $assoc_args
     */
    public function run($args, $assoc_args)
    {
        // TODO: Write the importer class.
        WP_CLI::log('Starting import process...');

        WP_CLI::success(__CLASS__);
    }

}
