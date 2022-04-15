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
     * The template title option.
     *
     * @var null|bool $templateDateTime
     */
    protected $templateDateTime = null;

    /**
     * The template logo option.
     *
     * @var null|int $templateLogo
     */
    protected $templateLogo = null;

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
        add_filter('pre_option_witte_template_date_time', [$this, 'getTemplateDateTimeShortCircuit'], 10, 3);
        add_filter('pre_option_witte_template_logo', [$this, 'getTemplateLogoShortCircuit'], 10, 3);
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
     * Short circuit the option "witte_template_date_time" by triggering the getTemplateDateTime() method.
     *
     * @param  mixed  $preOption
     * @param  string  $option
     * @param  mixed  $default
     *
     * @return bool
     */
    public function getTemplateDateTimeShortCircuit($preOption, $option, $default)
    {
        // TODO: The short circuit won't trigger the native WordPress caching system. Implement it manually.
        if ('witte_template_date_time' != $option)
            return $preOption; // It should never happen, since the hook is already specific for our scenario.

        return $this->getTemplateDateTime();
    }

    /**
     * Get the template date time option of the plugin.
     *
     * @param  bool  $force  Retrieve the data from the current stored class property or from the database.
     *
     * @return bool
     */
    public function getTemplateDateTime($force = false)
    {
        if (false === $force) {
            $templateDateTime = $this->templateDateTime;
            if (false === empty($templateDateTime))
                return $templateDateTime;
        }

        $templateDateTime = carbon_get_theme_option('witte_template_date_time'); // TODO: Retrieve the key from the appropriate class.
        $templateDateTime = boolval($templateDateTime);

        $this->templateDateTime = $templateDateTime;

        return $templateDateTime;
    }

    /**
     * Short circuit the option "witte_template_logo" by triggering the getTemplateLogo() method.
     *
     * @param  mixed  $preOption
     * @param  string  $option
     * @param  mixed  $default
     *
     * @return int
     */
    public function getTemplateLogoShortCircuit($preOption, $option, $default)
    {
        // TODO: The short circuit won't trigger the native WordPress caching system. Implement it manually.
        if ('witte_template_logo' != $option)
            return $preOption; // It should never happen, since the hook is already specific for our scenario.

        return $this->getTemplateLogo();
    }

    /**
     * Get the template logo option of the plugin.
     *
     * @param  bool  $force  Retrieve the data from the current stored class property or from the database.
     *
     * @return int
     */
    public function getTemplateLogo($force = false)
    {
        if (false === $force) {
            $templateLogo = $this->templateLogo;
            if (false === empty($templateLogo))
                return $templateLogo;
        }

        $templateLogo = carbon_get_theme_option('witte_template_logo'); // TODO: Retrieve the key from the appropriate class.
        $templateLogo = intval($templateLogo);

        $this->templateLogo = $templateLogo;

        return $templateLogo;
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
