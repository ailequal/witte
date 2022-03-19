<?php

namespace Ailequal\Plugins\Witte\Controllers\CustomPostType\Course;

use Ailequal\Plugins\Witte\Controllers\OptionPage;
use Ailequal\Plugins\Witte\Traits\DependencyInjection;
use Ailequal\Plugins\Witte\Traits\Singleton;

/**
 * The Data plugin class for the course.
 * Define the methods for retrieving the course meta box data.
 *
 * All the dependencies injected as magic methods:
 * @property OptionPage\Option\Data $optionData
 */
class Data
{

    // TODO: Consider adding the short-circuits hooks for the plugin options.

    use Singleton;
    use DependencyInjection;

    /**
     * Get the translations meta data of a course.
     *
     * @param  int  $course_id
     *
     * @return array
     */
    public function getTranslations($course_id)
    {
        $languages = $this->optionData->getLanguages();

        $translations = [];
        foreach ($languages as $key => $label) {
            $translation = carbon_get_post_meta($course_id, "witte_translation_$key");
            if (true == is_null($translation))
                $translation = '—';

            $translations[$key] = $translation;
        }

        return $translations;
    }

    /**
     * Get the translation meta data of a course relate to a specific language.
     * Keep in mind that it will obviously only work with the enabled languages.
     *
     * @param  int  $course_id
     * @param  string  $key
     *
     * @return string
     */
    public function getTranslation($course_id, $key)
    {
        $translations = $this->getTranslations($course_id);

        return (false == array_key_exists($key, $translations)) ? '—' : $translations[$key];
    }

}
