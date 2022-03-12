<?php

namespace Ailequal\Plugins\Witte\Utilities;

use Ailequal\Plugins\Witte\Abstracts\Hook;
use Ailequal\Plugins\Witte\Traits\Singleton;
use Carbon_Fields\Carbon_Fields;

/**
 * The CarbonFields plugin class.
 * Loads the Carbon Fields library from composer.
 */
class CarbonFields extends Hook
{

    use Singleton;

    /**
     * Loads all the hooks related to this class.
     */
    public function hooks()
    {
        add_action('after_setup_theme', [$this, 'init']);
    }

    /**
     * Loads the Carbon Fields library.
     */
    public function init()
    {
        Carbon_Fields::boot();
    }

}
