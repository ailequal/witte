<?php

namespace Ailequal\Plugins\Witte\Utilities;

use Ailequal\Plugins\Witte\Traits\Singleton;

/**
 * The Deactivator plugin class.
 * Define the deactivation functionality.
 */
class Deactivator
{

    use Singleton;

    /**
     * Initialize the class functionalities.
     */
    public function init()
    {
        register_deactivation_hook(WITTE_BASE_PATH.WITTE_SLUG.'.php', [$this, 'deactivationCallback']);
    }

    /**
     * The deactivation method handler.
     */
    public function deactivationCallback()
    {
        // TODO: Do something when the plugin is activated (like a notice, or disabling the plugin cron).
    }

}
