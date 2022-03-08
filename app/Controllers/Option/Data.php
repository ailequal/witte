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

        $languages = carbon_get_theme_option('witte_languages');

        $this->languages = $languages;

        return $languages;
    }

}
