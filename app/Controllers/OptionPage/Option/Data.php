<?php

namespace Ailequal\Plugins\Witte\Controllers\OptionPage\Option;

use Ailequal\Plugins\Witte\Abstracts\Hook;
use Ailequal\Plugins\Witte\Controllers\Language;
use Ailequal\Plugins\Witte\Traits\DependencyInjection;
use Ailequal\Plugins\Witte\Traits\Singleton;

/**
 * The Data plugin class for the option.
 * Define the methods for retrieving the plugin option data.
 *
 * All the dependencies injected as magic methods:
 * @property Language $language
 */
class Data extends Hook
{

    // TODO: Consider adding the short-circuits hooks for the plugin options.

    use Singleton;
    use DependencyInjection;

    /**
     * The template title option.
     *
     * @var string $templateTitle
     */
    protected $templateTitle = '';

    /**
     * The languages option.
     *
     * @var null|array $languages
     */
    protected $languages = null;

    /**
     * Loads all the hooks related to this class.
     */
    public function hooks()
    {
        add_filter('pre_option_witte_template_title', [$this, 'getTemplateTitleShortCircuit'], 10, 3);
    }

    /**
     * Short circuit the option "witte_template_title" by triggering the getTemplateTitle() method.
     *
     * @param  mixed  $preOption
     * @param  string  $option
     * @param  mixed  $default
     *
     * @return string
     */
    public function getTemplateTitleShortCircuit($preOption, $option, $default)
    {
        // TODO: The short circuit won't trigger the native WordPress caching system. Implement it manually.
        if ('witte_template_title' != $option)
            return $preOption; // It should never happen, since the hook is already specific for our scenario.

        return $this->getTemplateTitle();
    }

    /**
     * Get the template title option of the plugin.
     *
     * @param  bool  $force  Retrieve the data from the current stored class property or from the database.
     *
     * @return string
     */
    public function getTemplateTitle($force = false)
    {
        if (false === $force) {
            $templateTitle = $this->templateTitle;
            if (false === empty($templateTitle))
                return $templateTitle;
        }

        $templateTitle = carbon_get_theme_option('witte_template_title'); // TODO: Retrieve the key from the appropriate class.
        if (false == is_string($templateTitle))
            $templateTitle = '';

        $this->templateTitle = $templateTitle;

        return $templateTitle;
    }

    /**
     * Get the languages option of the plugin.
     *
     * @param  bool  $force  Retrieve the data from the current stored class property or from the database.
     *
     * @return array
     */
    public function getLanguages($force = false)
    {
        if (false === $force) {
            $languages = $this->languages;
            if (false === is_null($languages))
                return $languages;
        }

        $rawLanguages = carbon_get_theme_option('witte_languages'); // TODO: Retrieve the key from the appropriate class.
        $languages    = $this->parseLanguages($rawLanguages);

        $this->languages = $languages;

        return $languages;
    }

    /**
     * Parse the raw languages option of the plugin.
     *
     * @param $rawLanguages
     *
     * @return array
     */
    protected function parseLanguages($rawLanguages)
    {
        $languages        = [];
        $defaultLanguages = $this->language->getOptions();

        if (true == empty($rawLanguages))
            return array_slice($defaultLanguages, 0, 2); // Return just a subset of the available options as default.

        // Extract the stored languages key from the option.
        foreach ($rawLanguages as $key => $data) {
            if (false == is_array($data) || true == empty($data))
                continue;

            if (false == isset($data['_type']) || 'language' != $data['_type'])
                continue;

            if (false == isset($data['language']) || true == empty($data['language']))
                continue;

            // Assign to each language key its appropriate label.
            $keyLanguage = $data['language'];
            if (false == array_key_exists($keyLanguage, $defaultLanguages))
                continue;

            // Assigning values in this way will automatically avoid any possible duplicate.
            $languages[$keyLanguage] = $defaultLanguages[$keyLanguage];
        }

        return $languages;
    }

}
