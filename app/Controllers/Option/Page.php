<?php

namespace Ailequal\Plugins\Witte\Controllers\Option;

use Ailequal\Plugins\Witte\Abstracts\Hook;
use Ailequal\Plugins\Witte\Controllers\Language;
use Ailequal\Plugins\Witte\Traits\DependencyInjection;
use Ailequal\Plugins\Witte\Traits\Singleton;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * The Page plugin class.
 * Register the plugin option page.
 *
 * All the dependencies injected as magic methods:
 * @property Language $language
 */
class Page extends Hook
{

    use Singleton;
    use DependencyInjection;

    /**
     * Get the option error message.
     *
     * @return string
     */
    protected function getOptionError()
    {
        return __("Cannot generate the options page with Carbon Fields.", 'witte');
    }

    /**
     * Get the field error message.
     *
     * @return string
     */
    protected function getFieldError()
    {
        return __("Cannot generate a field with Carbon Fields.", 'witte');
    }

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
            wp_die($this->getOptionError());

        $optionsPage->set_page_file('witte'); // Set the custom options page slug.
//        $options_page->set_icon('icon.png'); // TODO: Add a custom icon for the plugin options.

        // Add multiple tab support (it's always the same page) and inject all the fields inside the page.
        $optionsPage->add_tab(__('Week plan', 'witte'), [
            Field::make('text', 'aaa', 'aaa'),
            $this->getAssociation('monday'),
            $this->getAssociation('thursday'),
            $this->getAssociation('wednesday'),
        ]);
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
     * Get the association field.
     *
     * @return Field\Association_Field
     */
    protected function getAssociation($key)
    {
        $association = Field::make('association', $key, __('Association'));
        if (false == is_a($association, '\Carbon_Fields\Field\Association_Field'))
            wp_die($this->getFieldError());

        $association->set_types([
            [
                'type'      => 'post',
                'post_type' => 'course',
            ]
        ]);
        $association->set_max(1);

        return $association;
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
            wp_die($this->getFieldError());

        $languageDescription->set_html(sprintf(
            '<p>%s</p>',
            __('Define all the languages that will be handled by Witte.
                The order will be reflected on the template and all the other plugin functionalities.
                Without a selection, the plugin will automatically pick the first two language options.', 'witte')
        ));

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
            wp_die($this->getFieldError());

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
            wp_die($this->getFieldError());

        $languageSelect->set_options($this->language->getOptions());

        return $languageSelect;
    }

}
