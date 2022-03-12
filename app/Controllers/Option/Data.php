<?php

namespace Ailequal\Plugins\Witte\Controllers\Option;

use Ailequal\Plugins\Witte\Controllers\Language;
use Ailequal\Plugins\Witte\Traits\DependencyInjection;
use Ailequal\Plugins\Witte\Traits\Singleton;

/**
 * The Data plugin class.
 * Define the methods for retrieving the plugin option data.
 *
 * All the dependencies injected as magic methods:
 * @property Language $language
 */
class Data
{

    // TODO: Consider adding the short-circuits hooks for the plugin options.

    use Singleton;
    use DependencyInjection;

    /**
     * The languages option.
     *
     * @var null|array $languages
     */
    protected $languages = null;

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

            $languages[$keyLanguage] = $defaultLanguages[$keyLanguage];
        }

        return $languages;
    }

}
