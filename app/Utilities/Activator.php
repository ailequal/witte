<?php

namespace Ailequal\Plugins\Witte\Utilities;

use Ailequal\Plugins\Witte\Traits\Singleton;

/**
 * The Activator plugin class.
 * Define the activation functionality.
 */
class Activator
{

    use Singleton;

    /**
     * Initialize the class functionalities.
     */
    public function init()
    {
        register_activation_hook(WITTE_BASEPATH.WITTE_SLUG.'.php', [$this, 'activationCallback']);
    }

    /**
     * The activation method handler.
     */
    public function activationCallback()
    {
        // TODO: Do something when the plugin is activated (like a notice).
    }

}
