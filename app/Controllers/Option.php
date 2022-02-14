<?php

namespace Ailequal\Plugins\Witte\Controllers;

use Ailequal\Plugins\Witte\Abstracts\Hook;
use Ailequal\Plugins\Witte\Traits\Singleton;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * The Option plugin class.
 * Define the option functionality.
 */
class Option extends Hook
{

    use Singleton;

    /**
     * Loads all the hooks related to this class.
     */
    public function hooks()
    {
        add_action('carbon_fields_register_fields', [$this, 'registerOptionsPage']);
    }

    /**
     * Register the options page and its related fields.
     */
    public function registerOptionsPage()
    {
        // Check if it's the right class in order to have the correct IDE suggestions.
        $options_page = Container::make('theme_options', __('Witte'));
        if (false == is_a($options_page, '\Carbon_Fields\Container\Theme_Options_Container'))
            return;

        // Set the custom options page slug.
        $options_page->set_page_file('witte');

        // Add sample fields.
        $options_page->add_fields([
            Field::make('header_scripts', 'crb_header_script', __('Header Script')),
            Field::make('footer_scripts', 'crb_footer_script', __('Footer Script'))
        ]);

        // Add multiple tab support (it's always the same page).
        $options_page->add_tab(__('Profile'), [
            Field::make('text', 'crb_first_name', 'First Name'),
            Field::make('text', 'crb_last_name', 'Last Name'),
            Field::make('text', 'crb_position', 'Position'),
        ]);
        $options_page->add_tab(__('Notification'), [
            Field::make('text', 'crb_email', 'Notification Email'),
            Field::make('text', 'crb_phone', 'Phone Number'),
        ]);
    }

}
