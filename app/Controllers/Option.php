<?php

namespace Ailequal\Plugins\Witte\Controllers;

use Ailequal\Plugins\Witte\Abstracts\Hook;
use Ailequal\Plugins\Witte\Traits\DependencyInjection;
use Ailequal\Plugins\Witte\Traits\Singleton;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * The Option plugin class.
 * Define the option functionality.
 *
 * All the dependencies injected as magic methods:
 * @property Language $language
 */
class Option extends Hook
{

    use Singleton;
    use DependencyInjection;

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
        // Register the new page.
        $optionsPage = Container::make('theme_options', __('Witte', 'witte'));
        if (false == is_a($optionsPage, '\Carbon_Fields\Container\Theme_Options_Container'))
            wp_die(__("Cannot generate the options page with Carbon Fields.", 'witte'));

        $optionsPage->set_page_file('witte'); // Set the custom options page slug.
//        $options_page->set_icon('icon.png'); // TODO: Add a custom icon for the plugin options.

        // Add multiple tab support (it's always the same page) and inject all the fields inside the page.
        $optionsPage->add_tab(__('Languages', 'witte'), [
            $this->getLanguageDescription(),
            $this->getLanguageRepeater()
        ]);
        $optionsPage->add_tab(__('Beta', 'witte'), [
            Field::make('text', 'crb_first_name', 'First Name'),
            Field::make('text', 'crb_last_name', 'Last Name'),
            Field::make('text', 'crb_email', 'Notification Email'),
            Field::make('text', 'crb_phone', 'Phone Number')
        ]);
    }

    /**
     * Get the language description html field.
     *
     * @return Field\Html_Field
     */
    protected function getLanguageDescription()
    {
        $languageDescription = Field::make('html', 'language_description');
        if (false == is_a($languageDescription, '\Carbon_Fields\Field\Html_Field'))
            wp_die(__("Cannot generate a field with Carbon Fields.", 'witte'));

        $languageDescription->set_html($this->language->getDescription());

        return $languageDescription;
    }

    /**
     * Get the language repeater field.
     *
     * @return Field\Complex_Field
     */
    protected function getLanguageRepeater()
    {
        $languageRepeater = Field::make('complex', 'witte_languages', '');
        if (false == is_a($languageRepeater, '\Carbon_Fields\Field\Complex_Field'))
            wp_die(__("Cannot generate a field with Carbon Fields.", 'witte'));

        $languageRepeater->add_fields(__('language', 'witte'), [$this->getLanguageSelect()]);

        return $languageRepeater;
    }

    /**
     * Get the language select field.
     *
     * @return Field\Select_Field
     */
    protected function getLanguageSelect()
    {
        $languageSelect = Field::make('select', 'language', '');
        if (false == is_a($languageSelect, '\Carbon_Fields\Field\Select_Field'))
            wp_die(__("Cannot generate a field with Carbon Fields.", 'witte'));

        $languageSelect->set_options($this->language->getOptions());

        return $languageSelect;
    }

}
