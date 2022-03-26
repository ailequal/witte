<?php

namespace Ailequal\Plugins\Witte\Controllers;

use Ailequal\Plugins\Witte\Abstracts\Hook;
use Ailequal\Plugins\Witte\Traits\DependencyInjection;
use Ailequal\Plugins\Witte\Traits\Singleton;
use Ailequal\Plugins\Witte\Utilities\Resource;

/**
 * The Template plugin class.
 * Define the customization for the witte template.
 *
 * All the dependencies injected as magic methods:
 * @property Resource $resource
 */
class Template extends Hook
{

    use Singleton;
    use DependencyInjection;

    /**
     * Loads all the hooks related to this class.
     */
    public function hooks()
    {
        add_action('wp_enqueue_scripts', [$this, 'frontendEnqueue'], 10, 1);
    }

    /**
     * Register the assets for the frontend.
     */
    public function frontendEnqueue()
    {
        // TODO: Add a custom filter for adding more custom templates externally.
        $templates = ['page-witte.php'];

        if (is_page_template($templates)) {
            wp_enqueue_style(
                'page-witte.css',
                $this->resource->getStylePath('page-witte'),
                [], WITTE_VERSION, 'all');

            wp_enqueue_script(
                'page-witte.js',
                $this->resource->getScriptPath('page-witte'),
                ['jquery'], WITTE_VERSION, true);
        }
    }

}
