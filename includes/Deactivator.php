<?php

namespace Ailequal\Plugins\Witte;

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
        register_deactivation_hook(WITTE_BASEPATH.WITTE_SLUG.'.php', [$this, 'deactivation_callback']);
    }

    /**
     * The deactivation method handler.
     */
    public function deactivation_callback()
    {
        // TODO: Do something when the plugin is activated (like a notice, or disabling the plugin cron).
    }

}
