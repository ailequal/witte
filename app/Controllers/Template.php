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

    // TODO: Instead of manually copying the template file from the plugin into the current theme,
    //  let's add the template directly from the plugin. See the guide below (it's not easily supported by WordPress).
    //  @link https://www.wpexplorer.com/wordpress-page-templates-plugin

    use Singleton;
    use DependencyInjection;

    /**
     * Loads all the hooks related to this class.
     */
    public function hooks()
    {
        add_action('wp_head', [$this, 'injectFonts'], 10, 1);
        add_action('wp_enqueue_scripts', [$this, 'frontendEnqueue'], 10, 1);
//        add_filter('show_admin_bar', '__return_false'); // TODO: Only for debugging.
    }

    /**
     * Inject the fonts for the frontend.
     */
    public function injectFonts()
    {
        // TODO: Consider storing and loading the fonts assets directly from the plugin.
        if (is_page_template('page_witte.php')) {
            ?>
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,700;1,400&display=swap"
                  rel="stylesheet">
            <?php
        }
    }

    /**
     * Register the assets for the frontend.
     */
    public function frontendEnqueue()
    {
        if (is_page_template('page_witte.php')) {
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
