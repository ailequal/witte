<?php

namespace Ailequal\Plugins\Witte;

use Ailequal\Plugins\Witte\Traits\Singleton;

/**
 * The internationalization plugin class.
 * Define the internationalization functionality.
 */
class I18n
{

    use Singleton;

    /**
     * Loads all the hooks related to this class.
     */
    public function hooks()
    {
        add_action('init', [$this, 'loadPluginTextdomain']);
    }

    /**
     * Load the plugin text domain for the internationalization.
     */
    public function loadPluginTextdomain()
    {
        // TODO: Add translations files.
        load_plugin_textdomain(
            WITTE_SLUG,
            false,
            WITTE_SLUG.'/languages/'
        );
    }

}
