<?php

namespace Ailequal\Plugins\Witte;

use Ailequal\Plugins\Witte\Traits\DependencyInjection;
use Ailequal\Plugins\Witte\Traits\Singleton;

/**
 * The Beta plugin class.
 * Define the beta example functionality.
 *
 * All the dependencies injected as magic methods:
 * @property Alpha $alpha
 */
class Beta
{

    use Singleton;
    use DependencyInjection;

    /**
     * Loads all the hooks related to this class.
     */
    public function hooks()
    {
        add_action('wp_footer', [$this, 'wp_footer_callback']);
    }

    /**
     * wp_footer_callback()
     */
    public function wp_footer_callback()
    {
        // Alwasy set the domain as a string, to allow any parser to actually catch the string.
        _e('Hello, dear user!', 'witte');

        echo __CLASS__;
        echo '<br>';
        echo $this->alpha->alpha();
    }

}
