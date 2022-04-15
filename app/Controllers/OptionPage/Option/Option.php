<?php

namespace Ailequal\Plugins\Witte\Controllers\OptionPage\Option;

use Ailequal\Plugins\Witte\Abstracts\Hook;
use Ailequal\Plugins\Witte\Controllers\Language;
use Ailequal\Plugins\Witte\Traits\DependencyInjection;
use Ailequal\Plugins\Witte\Traits\Singleton;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * The Option plugin class.
 * Register the plugin option page.
 *
 * All the dependencies injected as magic methods:
 * @property Language $language
 */
class Option extends Hook
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
        add_action('carbon_fields_register_fields', [$this, 'registerOptionsPage'], 10, 1);
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
        $optionsPage->add_tab(__('Template', 'witte'), [
            $this->getTemplateTitle(),
            $this->getTemplateDateTime(),
            $this->getTemplateLogo(),
            $this->getTemplateLunch(),
            $this->getTemplateDinner(),
            $this->getTemplateMessage(),
        ]);
        $optionsPage->add_tab(__('Languages', 'witte'), [
            $this->getLanguageDescription(),
            $this->getLanguageRepeater()
        ]);
        $optionsPage->add_tab(__('Options', 'witte'), [
            Field::make('text', 'wip', 'WIP'),
            // TODO: Add an option for setting the first week day (or just use the setting from WordPress itself).
        ]);
    }

    /**
     * Get the template title field.
     *
     * @return Field\Text_Field
     */
    protected function getTemplateTitle()
    {
        $templateTitle = Field::make('text', 'witte_template_title', __('Title', 'witte'));
        if (false == is_a($templateTitle, '\Carbon_Fields\Field\Text_Field'))
            wp_die($this->getFieldError());

        $templateTitle->set_help_text(__('The template title.', 'witte'));

        return $templateTitle;
    }

    /**
     * Get the template date time field.
     *
     * @return Field\Checkbox_Field
     */
    protected function getTemplateDateTime()
    {
        $templateDateTime = Field::make('checkbox', 'witte_template_date_time', __('Date and time', 'witte'));
        if (false == is_a($templateDateTime, '\Carbon_Fields\Field\Checkbox_Field'))
            wp_die($this->getFieldError());

        $templateDateTime->set_help_text(__('Enable showing the date and time inside the template.', 'witte'));

        return $templateDateTime;
    }

    /**
     * Get the template logo field.
     *
     * @return Field\Image_Field
     */
    protected function getTemplateLogo()
    {
        $templateLogo = Field::make('image', 'witte_template_logo', __('Logo', 'witte'));
        if (false == is_a($templateLogo, '\Carbon_Fields\Field\Image_Field'))
            wp_die($this->getFieldError());

        $templateLogo->set_type('image');
        $templateLogo->set_value_type('id');
        $templateLogo->set_help_text(__('Set the template logo.', 'witte'));

        return $templateLogo;
    }

    /**
     * Get the template lunch title field.
     *
     * @return Field\Text_Field
     */
    protected function getTemplateLunch()
    {
        $templateLunch = Field::make('text', 'witte_template_lunch', __('Lunch', 'witte'));
        if (false == is_a($templateLunch, '\Carbon_Fields\Field\Text_Field'))
            wp_die($this->getFieldError());

        $templateLunch->set_help_text(__('Set the template lunch title.', 'witte'));

        return $templateLunch;
    }

    /**
     * Get the template dinner title field.
     *
     * @return Field\Text_Field
     */
    protected function getTemplateDinner()
    {
        $templateDinner = Field::make('text', 'witte_template_dinner', __('Dinner', 'witte'));
        if (false == is_a($templateDinner, '\Carbon_Fields\Field\Text_Field'))
            wp_die($this->getFieldError());

        $templateDinner->set_help_text(__('Set the template dinner title.', 'witte'));

        return $templateDinner;
    }

    /**
     * Get the template message field.
     *
     * @return Field\Textarea_Field
     */
    protected function getTemplateMessage()
    {
        $templateMessage = Field::make('textarea', 'witte_template_message', __('Message', 'witte'));
        if (false == is_a($templateMessage, '\Carbon_Fields\Field\Textarea_Field'))
            wp_die($this->getFieldError());

        $templateMessage->set_rows(3);
        $templateMessage->set_attribute('placeholder',
            __('For any additional request, please contact "(***) ***-****".', 'witte'));
        $templateMessage->set_help_text(__('Set the template message.', 'witte'));

        return $templateMessage;
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
