<?php

namespace Ailequal\Plugins\Witte;

use Ailequal\Plugins\Witte\Traits\Singleton;

/**
 * The Core plugin class.
 * All the plugin logic will be handled starting from this class.
 */
class Core
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
     * Register all the plugin classes (and optionally their relative hooks or other functionalities).
     */
    private function classes()
    {
        Activator::getInstance()->init();
        Deactivator::getInstance()->init();
        I18n::getInstance()->hooks();
        Alpha::getInstance()->hooks();
        Beta::getInstance()->hooks();
        WpCli::getInstance()->hooks();

        // TODO: Add partial controller class??
        // TODO: Add shared class with options??
        // TODO: Add logger class.
    }

    /**
     * Register all the needed dependencies for the plugin classes.
     */
    private function dependencies()
    {
        Beta::getInstance()->injectDependency('alpha', Alpha::getInstance());
    }

}
