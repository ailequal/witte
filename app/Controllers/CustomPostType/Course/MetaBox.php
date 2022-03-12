<?php

namespace Ailequal\Plugins\Witte\Controllers\CustomPostType\Course;

use Ailequal\Plugins\Witte\Abstracts\Hook;
use Ailequal\Plugins\Witte\Controllers\Option;
use Ailequal\Plugins\Witte\Traits\DependencyInjection;
use Ailequal\Plugins\Witte\Traits\Singleton;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * The MetaBox plugin class for the course.
 * Define the meta box for the course.
 *
 * All the dependencies injected as magic methods:
 * @property Option\Data $data
 */
class MetaBox extends Hook
{

    use Singleton;
    use DependencyInjection;

    /**
     * Get the meta box error message.
     *
     * @return string
     */
    protected function getMetaBoxError()
    {
        return __("Cannot generate the meta box with Carbon Fields.", 'witte');
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
        add_action('carbon_fields_register_fields', [$this, 'registerMetabox']);
    }

    /**
     * Register the meta box and its related fields.
     */
    public function registerMetabox()
    {
        // Register the new meta box.
        $metaBox = Container::make('post_meta', __('Translations', 'witte'));
        if (false == is_a($metaBox, '\Carbon_Fields\Container\Post_Meta_Container'))
            wp_die($this->getMetaBoxError());

        $metaBox->where('post_type', '=', 'course');
        $metaBox->add_fields($this->getTranslationsText());
    }

    /**
     * Get the translations text field.
     *
     * @return array
     */
    protected function getTranslationsText()
    {
        $languages = $this->data->getLanguages();

        $translationsText = [];
        foreach ($languages as $key => $label) {
            $translationText    = $this->getTranslationText($key, $label);
            $translationsText[] = $translationText;
        }

        return $translationsText;
    }

    /**
     * Get the translation text field.
     *
     * @param  string  $key
     * @param  string  $label
     *
     * @return Field\Text_Field
     */
    protected function getTranslationText($key, $label)
    {
        $translationText = Field::make('text', $key, $label);
        if (false == is_a($translationText, '\Carbon_Fields\Field\Text_Field'))
            wp_die($this->getFieldError());

        $translationText->set_attribute('placeholder', '—');

        return $translationText;
    }

}
