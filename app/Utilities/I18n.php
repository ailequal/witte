<?php

namespace Ailequal\Plugins\Witte\Utilities;

use Ailequal\Plugins\Witte\Abstracts\Hook;
use Ailequal\Plugins\Witte\Traits\Singleton;

/**
 * The internationalization plugin class.
 * Define the internationalization functionality.
 */
class I18n extends Hook
{

    use Singleton;

    /**
     * Loads all the hooks related to this class.
     */
    public function hooks()
    {
        // It's super important to always load our textdomain on "init" hook,
        // with a zero priority, otherwise Carbon Fields will be executed before us,
        // nullifying our translations for it!!
        add_action('init', [$this, 'loadPluginTextdomain'], 0, 1);
    }

    /**
     * Load the plugin text domain for the internationalization.
     */
    public function loadPluginTextdomain()
    {
        load_plugin_textdomain(
            WITTE_SLUG,
            false,
            WITTE_SLUG.'/resources/lang'
        );
    }

}
