<?php

namespace Ailequal\Plugins\Witte\Controllers;

use Ailequal\Plugins\Witte\Abstracts\Hook;
use Ailequal\Plugins\Witte\Utilities\Resource;
use Ailequal\Plugins\Witte\Traits\DependencyInjection;
use Ailequal\Plugins\Witte\Traits\Singleton;

/**
 * The Beta plugin class.
 * Define the beta example functionality.
 *
 * All the dependencies injected as magic methods:
 * @property Alpha $alpha
 * @property Resource $resource
 */
class Beta extends Hook
{

    use Singleton;
    use DependencyInjection;

    /**
     * Loads all the hooks related to this class.
     */
    public function hooks()
    {
        add_action('admin_enqueue_scripts', [$this, 'backendEnqueue']);
        add_action('wp_enqueue_scripts', [$this, 'frontendEnqueue']);
        add_action('wp_footer', [$this, 'wpFooterCallback']);
    }

    /**
     * Register the assets for the backend.
     */
    public function backendEnqueue() { }

    /**
     * Register the assets for the frontend.
     */
    public function frontendEnqueue()
    {
        wp_enqueue_style('', $this->resource->getStylePath('style'), [], WITTE_VERSION, 'all');
        wp_enqueue_script('', $this->resource->getScriptPath('script'), ['jquery'], WITTE_VERSION, true);
    }

    /**
     * wpFooterCallback()
     */
    public function wpFooterCallback()
    {
        // Call method from an injected class.
        echo '<br>=== DEPENDENCY INJECTION ===<br>';
        echo $this->alpha->alpha();
        echo '<br>============================<br>';

        // Always set the domain as a string to allow the parser to actually catch the strings.
        echo '<br>=== TRANSLATED STRING ===<br>';
        _e('Hello, dear user!', 'witte');
        echo '<br>========================<br>';

        // Get a view template and print it.
        echo '<br>=== View ===<br>';
        $this->resource->theView('template', ['time' => time()]);
        echo '<br>============<br>';
    }

}
