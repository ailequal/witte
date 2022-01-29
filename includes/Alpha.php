<?php

namespace Ailequal\Plugins\Witte;

use Ailequal\Plugins\Witte\Traits\Singleton;

/**
 * The Alpha plugin class.
 * Define the alpha example functionality.
 */
class Alpha
{

    use Singleton;

    /**
     * Loads all the hooks related to this class.
     */
    public function hooks()
    {
//        add_action('wp_footer', [$this, 'wp_footer_callback']);
    }

    /**
     * wp_footer_callback()
     */
    public function wp_footer_callback()
    {
        echo __CLASS__;
    }

    /**
     * alpha()
     *
     * @return string
     */
    public function alpha()
    {
        return 'alpha';
    }

}
