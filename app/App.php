<?php

namespace Ailequal\Plugins\Witte;

use Ailequal\Plugins\Witte\Traits\Singleton;

/**
 * The App plugin class.
 * All the plugin logic will be handled starting from this class.
 */
class App
{

    use Singleton;

    /**
     * Initialize the class.
     */
    public function init()
    {
        $this->classes();
        $this->dependencies();
    }

    /**
     * Register all the plugin classes
     * (and optionally their relative hooks or any other functionalities).
     */
    private function classes()
    {
        Utilities\Activator::getInstance()->init();
        Utilities\Deactivator::getInstance()->init();
        Utilities\I18n::getInstance()->hooks();

        Controllers\Alpha::getInstance()->hooks();
        Controllers\Beta::getInstance()->hooks();
        Controllers\CarbonFields::getInstance()->hooks();

        Commands\Gamma::getInstance()->hooks();
        Commands\Importer::getInstance()->hooks();
        Commands\Exporter::getInstance()->hooks();

        // TODO: Add logger class.
        // TODO: Add full rest api (required authentication?).
    }

    /**
     * Register all the needed dependencies for the plugin classes.
     */
    private function dependencies()
    {
        Controllers\Beta::getInstance()->injectDependency('alpha', Controllers\Alpha::getInstance());

        Commands\Gamma::getInstance()->injectDependency('alpha', Controllers\Alpha::getInstance());
    }

}
