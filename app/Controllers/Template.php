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
        if (is_page_template('page_witte.php')) {
            ?>
            <style>
                /* devanagari */
                @font-face {
                    font-family: 'Poppins';
                    font-style: italic;
                    font-weight: 400;
                    font-display: swap;
                    src: url(<?php echo WITTE_BASE_URL; ?>resources/fonts/poppins/pxiGyp8kv8JHgFVrJJLucXtAOvWDSHFF.woff2) format('woff2');
                    unicode-range: U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;
                }

                /* latin-ext */
                @font-face {
                    font-family: 'Poppins';
                    font-style: italic;
                    font-weight: 400;
                    font-display: swap;
                    src: url(<?php echo WITTE_BASE_URL; ?>resources/fonts/poppins/pxiGyp8kv8JHgFVrJJLufntAOvWDSHFF.woff2) format('woff2');
                    unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
                }

                /* latin */
                @font-face {
                    font-family: 'Poppins';
                    font-style: italic;
                    font-weight: 400;
                    font-display: swap;
                    src: url(<?php echo WITTE_BASE_URL; ?>resources/fonts/poppins/pxiGyp8kv8JHgFVrJJLucHtAOvWDSA.woff2) format('woff2');
                    unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
                }

                /* devanagari */
                @font-face {
                    font-family: 'Poppins';
                    font-style: normal;
                    font-weight: 300;
                    font-display: swap;
                    src: url(<?php echo WITTE_BASE_URL; ?>resources/fonts/poppins/pxiByp8kv8JHgFVrLDz8Z11lFd2JQEl8qw.woff2) format('woff2');
                    unicode-range: U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;
                }

                /* latin-ext */
                @font-face {
                    font-family: 'Poppins';
                    font-style: normal;
                    font-weight: 300;
                    font-display: swap;
                    src: url(<?php echo WITTE_BASE_URL; ?>resources/fonts/poppins/pxiByp8kv8JHgFVrLDz8Z1JlFd2JQEl8qw.woff2) format('woff2');
                    unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
                }

                /* latin */
                @font-face {
                    font-family: 'Poppins';
                    font-style: normal;
                    font-weight: 300;
                    font-display: swap;
                    src: url(<?php echo WITTE_BASE_URL; ?>resources/fonts/poppins/pxiByp8kv8JHgFVrLDz8Z1xlFd2JQEk.woff2) format('woff2');
                    unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
                }

                /* devanagari */
                @font-face {
                    font-family: 'Poppins';
                    font-style: normal;
                    font-weight: 400;
                    font-display: swap;
                    src: url(<?php echo WITTE_BASE_URL; ?>resources/fonts/poppins/pxiEyp8kv8JHgFVrJJbecnFHGPezSQ.woff2) format('woff2');
                    unicode-range: U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;
                }

                /* latin-ext */
                @font-face {
                    font-family: 'Poppins';
                    font-style: normal;
                    font-weight: 400;
                    font-display: swap;
                    src: url(<?php echo WITTE_BASE_URL; ?>resources/fonts/poppins/pxiEyp8kv8JHgFVrJJnecnFHGPezSQ.woff2) format('woff2');
                    unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
                }

                /* latin */
                @font-face {
                    font-family: 'Poppins';
                    font-style: normal;
                    font-weight: 400;
                    font-display: swap;
                    src: url(<?php echo WITTE_BASE_URL; ?>resources/fonts/poppins/pxiEyp8kv8JHgFVrJJfecnFHGPc.woff2) format('woff2');
                    unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
                }

                /* devanagari */
                @font-face {
                    font-family: 'Poppins';
                    font-style: normal;
                    font-weight: 700;
                    font-display: swap;
                    src: url(<?php echo WITTE_BASE_URL; ?>resources/fonts/poppins/pxiByp8kv8JHgFVrLCz7Z11lFd2JQEl8qw.woff2) format('woff2');
                    unicode-range: U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;
                }

                /* latin-ext */
                @font-face {
                    font-family: 'Poppins';
                    font-style: normal;
                    font-weight: 700;
                    font-display: swap;
                    src: url(<?php echo WITTE_BASE_URL; ?>resources/fonts/poppins/pxiByp8kv8JHgFVrLCz7Z1JlFd2JQEl8qw.woff2) format('woff2');
                    unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
                }

                /* latin */
                @font-face {
                    font-family: 'Poppins';
                    font-style: normal;
                    font-weight: 700;
                    font-display: swap;
                    src: url(<?php echo WITTE_BASE_URL; ?>resources/fonts/poppins/pxiByp8kv8JHgFVrLCz7Z1xlFd2JQEk.woff2) format('woff2');
                    unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
                }
            </style>
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
