<?php

namespace Ailequal\Plugins\Witte;

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
        register_activation_hook(WITTE_BASEPATH.WITTE_SLUG.'.php', [$this, 'activation_callback']);
    }

    /**
     * The activation method handler.
     */
    public function activation_callback()
    {
        // TODO: Do something when the plugin is activated (like a notice).
    }

}
