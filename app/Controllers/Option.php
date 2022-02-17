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
        $languageDescription = Field::make('html', 'language_description');
        if (false == is_a($languageDescription, '\Carbon_Fields\Field\Html_Field'))
            return;
        $languageDescription->set_html(sprintf(
            '<p>%s</p>',
            __('Define all the languages that will be handled by Witte.
                The order will be reflected on the template and all the other plugin functionalities.', 'witte')
        ));

        $languageSelect = Field::make('select', 'language', '');
        if (false == is_a($languageSelect, '\Carbon_Fields\Field\Select_Field'))
            return;
        $languageOptionsDefault = [
            'en' => __('English', 'witte'),
            'es' => __('Spanish', 'witte'),
            'de' => __('German', 'witte'),
            'fr' => __('French', 'witte'),
            'it' => __('Italian', 'witte')
        ]; // It is advice to follow the format ISO 639-1.
        $languageOptions        = apply_filters('witte_options_select_language', $languageOptionsDefault);
        if (false == is_array($languageOptions))
            $languageOptions = $languageOptionsDefault;
        $languageSelect->set_options($languageOptions);

        $languageRepeater = Field::make('complex', 'witte_languages', '');
        if (false == is_a($languageRepeater, '\Carbon_Fields\Field\Complex_Field'))
            return;
        $languageRepeater->add_fields(__('language', 'witte'), [$languageSelect]);

        // Register the new page.
        $optionsPage = Container::make('theme_options', __('Witte', 'witte'));
        if (false == is_a($optionsPage, '\Carbon_Fields\Container\Theme_Options_Container'))
            return;
        $optionsPage->set_page_file('witte'); // Set the custom options page slug.
//        $options_page->set_icon('icon.png'); // TODO: Add a custom icon for the plugin options.

        // Add multiple tab support (it's always the same page) and inject all the fields inside the page.
        $optionsPage->add_tab(__('Languages', 'witte'), [
            $languageDescription,
            $languageRepeater
        ]);
        $optionsPage->add_tab(__('Beta', 'witte'), [
            Field::make('text', 'crb_first_name', 'First Name'),
            Field::make('text', 'crb_last_name', 'Last Name'),
            Field::make('text', 'crb_email', 'Notification Email'),
            Field::make('text', 'crb_phone', 'Phone Number')
        ]);
    }

}
