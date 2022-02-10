<?php

namespace Ailequal\Plugins\Witte\Controllers;

use Ailequal\Plugins\Witte\Abstracts\Hook;
use Ailequal\Plugins\Witte\Traits\Singleton;

/**
 * The Alpha plugin class.
 * Define the alpha example functionality.
 */
class Alpha extends Hook
{

    use Singleton;

    /**
     * Loads all the hooks related to this class.
     */
    public function hooks()
    {
//        add_action('wp_footer', [$this, 'wpFooterCallback']);
    }

    /**
     * wpFooterCallback()
     */
    public function wpFooterCallback()
    {
        echo $this->alpha();
    }

    /**
     * alpha()
     *
     * @return string
     */
    public function alpha()
    {
        return __CLASS__;
    }

}
