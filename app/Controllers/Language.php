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
