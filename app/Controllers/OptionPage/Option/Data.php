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
     * The template subtitle option.
     *
     * @var string $templateSubtitle
     */
    protected $templateSubtitle = '';

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
     * The template lunch title option.
     *
     * @var string $templateLunch
     */
    protected $templateLunch = '';

    /**
     * The template dinner title option.
     *
     * @var string $templateDinner
     */
    protected $templateDinner = '';

    /**
     * The template message option.
     *
     * @var string $templateMessage
     */
    protected $templateMessage = '';

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
        add_filter('pre_option_witte_template_subtitle', [$this, 'getTemplateSubtitleShortCircuit'], 10, 3);
        add_filter('pre_option_witte_template_date_time', [$this, 'getTemplateDateTimeShortCircuit'], 10, 3);
        add_filter('pre_option_witte_template_logo', [$this, 'getTemplateLogoShortCircuit'], 10, 3);
        add_filter('pre_option_witte_template_lunch', [$this, 'getTemplateLunchShortCircuit'], 10, 3);
        add_filter('pre_option_witte_template_dinner', [$this, 'getTemplateDinnerShortCircuit'], 10, 3);
        add_filter('pre_option_witte_template_message', [$this, 'getTemplateMessageShortCircuit'], 10, 3);
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
     * Short circuit the option "witte_template_subtitle" by triggering the getTemplateSubtitle() method.
     *
     * @param  mixed  $preOption
     * @param  string  $option
     * @param  mixed  $default
     *
     * @return string
     */
    public function getTemplateSubtitleShortCircuit($preOption, $option, $default)
    {
        // TODO: The short circuit won't trigger the native WordPress caching system. Implement it manually.
        if ('witte_template_subtitle' != $option)
            return $preOption; // It should never happen, since the hook is already specific for our scenario.

        return $this->getTemplateSubtitle();
    }

    /**
     * Get the template subtitle option of the plugin.
     *
     * @param  bool  $force  Retrieve the data from the current stored class property or from the database.
     *
     * @return string
     */
    public function getTemplateSubtitle($force = false)
    {
        if (false === $force) {
            $templateSubtitle = $this->templateSubtitle;
            if (false === empty($templateSubtitle))
                return $templateSubtitle;
        }

        $templateSubtitle = carbon_get_theme_option('witte_template_subtitle'); // TODO: Retrieve the key from the appropriate class.
        if (false == is_string($templateSubtitle))
            $templateSubtitle = '';

        $this->templateSubtitle = $templateSubtitle;

        return $templateSubtitle;
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
     * Short circuit the option "witte_template_lunch" by triggering the getTemplateLunch() method.
     *
     * @param  mixed  $preOption
     * @param  string  $option
     * @param  mixed  $default
     *
     * @return string
     */
    public function getTemplateLunchShortCircuit($preOption, $option, $default)
    {
        // TODO: The short circuit won't trigger the native WordPress caching system. Implement it manually.
        if ('witte_template_lunch' != $option)
            return $preOption; // It should never happen, since the hook is already specific for our scenario.

        return $this->getTemplateLunch();
    }

    /**
     * Get the template lunch title option of the plugin.
     *
     * @param  bool  $force  Retrieve the data from the current stored class property or from the database.
     *
     * @return string
     */
    public function getTemplateLunch($force = false)
    {
        if (false === $force) {
            $templateLunch = $this->templateLunch;
            if (false === empty($templateLunch))
                return $templateLunch;
        }

        $templateLunch = carbon_get_theme_option('witte_template_lunch'); // TODO: Retrieve the key from the appropriate class.
        if (false == is_string($templateLunch))
            $templateLunch = '';

        $this->templateLunch = $templateLunch;

        return $templateLunch;
    }

    /**
     * Short circuit the option "witte_template_dinner" by triggering the getTemplateDinner() method.
     *
     * @param  mixed  $preOption
     * @param  string  $option
     * @param  mixed  $default
     *
     * @return string
     */
    public function getTemplateDinnerShortCircuit($preOption, $option, $default)
    {
        // TODO: The short circuit won't trigger the native WordPress caching system. Implement it manually.
        if ('witte_template_dinner' != $option)
            return $preOption; // It should never happen, since the hook is already specific for our scenario.

        return $this->getTemplateDinner();
    }

    /**
     * Get the template dinner title option of the plugin.
     *
     * @param  bool  $force  Retrieve the data from the current stored class property or from the database.
     *
     * @return string
     */
    public function getTemplateDinner($force = false)
    {
        if (false === $force) {
            $templateDinner = $this->templateDinner;
            if (false === empty($templateDinner))
                return $templateDinner;
        }

        $templateDinner = carbon_get_theme_option('witte_template_dinner'); // TODO: Retrieve the key from the appropriate class.
        if (false == is_string($templateDinner))
            $templateDinner = '';

        $this->templateDinner = $templateDinner;

        return $templateDinner;
    }

    /**
     * Short circuit the option "witte_template_message" by triggering the getTemplateMessage() method.
     *
     * @param  mixed  $preOption
     * @param  string  $option
     * @param  mixed  $default
     *
     * @return string
     */
    public function getTemplateMessageShortCircuit($preOption, $option, $default)
    {
        // TODO: The short circuit won't trigger the native WordPress caching system. Implement it manually.
        if ('witte_template_message' != $option)
            return $preOption; // It should never happen, since the hook is already specific for our scenario.

        return $this->getTemplateMessage();
    }

    /**
     * Get the template message option of the plugin.
     *
     * @param  bool  $force  Retrieve the data from the current stored class property or from the database.
     *
     * @return string
     */
    public function getTemplateMessage($force = false)
    {
        if (false === $force) {
            $templateMessage = $this->templateMessage;
            if (false === empty($templateMessage))
                return $templateMessage;
        }

        $templateMessage = carbon_get_theme_option('witte_template_message'); // TODO: Retrieve the key from the appropriate class.
        if (false == is_string($templateMessage))
            $templateMessage = '';

        $this->templateMessage = $templateMessage;

        return $templateMessage;
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
