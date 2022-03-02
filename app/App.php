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
        // TODO: Create three separate methods: utilities(), controllers() and commands().
        //  The classes() won't exist anymore, but we will still have a single dependencies().

        Utilities\Activator::getInstance()->init();
        Utilities\Deactivator::getInstance()->init();
        Utilities\I18n::getInstance()->hooks();
        Utilities\CarbonFields::getInstance()->hooks();

        Controllers\Alpha::getInstance()->hooks();
        Controllers\Beta::getInstance()->hooks();
        Controllers\Option::getInstance()->hooks();

        Commands\Gamma::getInstance()->hooks();
        Commands\Importer::getInstance()->hooks();
        Commands\Exporter::getInstance()->hooks();

        // TODO: Add full rest api (required authentication?).
        // TODO: Optimize autoloader for production.
        // TODO: Extract the relative plugin skeleton.
    }

    /**
     * Register all the needed dependencies for the plugin classes.
     */
    private function dependencies()
    {
        Controllers\Beta::getInstance()->injectDependency('alpha', Controllers\Alpha::getInstance());
        Controllers\Beta::getInstance()->injectDependency('resource', Utilities\Resource::getInstance());
        Controllers\Beta::getInstance()->injectDependency('log', Utilities\Log::getInstance());
        Controllers\Option::getInstance()->injectDependency('language', Controllers\Language::getInstance());

        Commands\Gamma::getInstance()->injectDependency('alpha', Controllers\Alpha::getInstance());
    }

}
