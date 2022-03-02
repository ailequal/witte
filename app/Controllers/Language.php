<?php

namespace Ailequal\Plugins\Witte\Controllers;

use Ailequal\Plugins\Witte\Traits\Singleton;

/**
 * The Language plugin class.
 * Define the language functionality.
 */
class Language
{

    use Singleton;

    /**
     * The description.
     *
     * @var null|string $description
     */
    protected $description = null;

    /**
     * The options default.
     *
     * @var null|array $optionsDefault
     */
    protected $optionsDefault = null;

    /**
     * The options.
     *
     * @var null|array $options
     */
    protected $options = null;

    /**
     * Get the description (formatted for Carbon Fields).
     *
     * @return string
     */
    public function getDescription()
    {
        $description = $this->description;
        if (false === is_null($description))
            return $description;

        $description = sprintf(
            '<p>%s</p>',
            __('Define all the languages that will be handled by Witte.
                The order will be reflected on the template and all the other plugin functionalities.', 'witte')
        );

        $this->description = $description;

        return $description;
    }

    /**
     * Get the options default (formatted for Carbon Fields).
     *
     * @return array
     */
    protected function getOptionsDefault()
    {
        $optionsDefault = $this->optionsDefault;
        if (false === is_null($optionsDefault))
            return $optionsDefault;

        $optionsDefault = [
            'en' => __('English', 'witte'),
            'es' => __('Spanish', 'witte'),
            'de' => __('German', 'witte'),
            'fr' => __('French', 'witte'),
            'it' => __('Italian', 'witte')
        ];

        $this->optionsDefault = $optionsDefault;

        return $optionsDefault;
    }

    /**
     * Get the options (formatted for Carbon Fields).
     *
     * @return array
     */
    public function getOptions()
    {
        $options = $this->options;
        if (false === is_null($options))
            return $options;

        // It is advice to follow the format ISO 639-1 for the select value.
        // The key value inside the array will determine how to store the data across the whole plugin.
        $optionsDefault = $this->getOptionsDefault();
        $options        = apply_filters('witte_language_options', $optionsDefault);
        if (false == is_array($options))
            $options = $optionsDefault;

        $this->options = $options;

        return $options;
    }

}
