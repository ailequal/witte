<?php

namespace Ailequal\Plugins\Witte\Controllers\OptionPage\WeekPlan;

use Ailequal\Plugins\Witte\Abstracts\Hook;
use Ailequal\Plugins\Witte\Controllers\CustomPostType;
use Ailequal\Plugins\Witte\Controllers\Week;
use Ailequal\Plugins\Witte\Traits\DependencyInjection;
use Ailequal\Plugins\Witte\Traits\Singleton;

/**
 * The Data plugin class for the week plan.
 * Define the methods for retrieving the plugin week plan data.
 *
 * All the dependencies injected as magic methods:
 * @property Week $week
 * @property CustomPostType\Course\Data $courseData
 */
class Data extends Hook
{

    // TODO: Consider adding the short-circuits hooks for the plugin week data.
    // TODO: What kind of data to we really need from this class??
    //  e.g. The day complete schedule, only the lunch, only the first course of the lunch...

    use Singleton;
    use DependencyInjection;

    /**
     * Loads all the hooks related to this class.
     */
    public function hooks()
    {
        add_filter('pre_option_witte_day_plan', [$this, 'getDayShortCircuit'], 10, 3);
    }

    /**
     * Short circuit the option "witte_day_plan" by triggering the getDay() method.
     *
     * @param  mixed  $pre_option
     * @param  string  $option
     * @param  mixed  $default
     *
     * @return array
     */
    public function getDayShortCircuit($pre_option, $option, $default)
    {
        // TODO: The short circuit won't trigger the native WordPress caching system. Implement it manually.
        if ('witte_day_plan' != $option)
            return $pre_option; // It should never happen, since the hook is already specific for our scenario.

        $day = $this->getDay();
        if (false == is_array($day) || true == empty($day))
            return $default;

        return $day;
    }

    /**
     * Get the requested or current day option of the plugin.
     *
     * @param  string  $day  The day name (lowercase).
     * @param  bool  $parse  Parse the data from carbon format to the course id.
     * @param  bool  $format  Format the course data for the frontend (requires parsing).
     *
     * @return array
     */
    public function getDay($day = '', $parse = true, $format = true)
    {
        // Without passing a specific day, automatically retrieve the current day based on the date.
        if (false == is_string($day) || true == empty($day))
            $day = $this->week->getToday();

        // TODO: Retrieve the key from the appropriate class.
        // TODO: Consider allowing multiple courses for a course category (e.g. second course with two courses: meat and potatoes).
        $rawDay = [
            'lunch'  => [
                'starter'       => carbon_get_theme_option($day.'_lunch_starter'),
                'first_course'  => carbon_get_theme_option($day.'_lunch_first_course'),
                'second_course' => carbon_get_theme_option($day.'_lunch_second_course'),
                'dessert'       => carbon_get_theme_option($day.'_lunch_dessert')
            ],
            'dinner' => [
                'starter'       => carbon_get_theme_option($day.'_dinner_starter'),
                'first_course'  => carbon_get_theme_option($day.'_dinner_first_course'),
                'second_course' => carbon_get_theme_option($day.'_dinner_second_course'),
                'dessert'       => carbon_get_theme_option($day.'_dinner_dessert')
            ]
        ];

        if (false == $parse)
            return $rawDay;

        return $this->parseDay($rawDay, $format);
    }

    /**
     * Parse the raw day option of the plugin.
     *
     * @param  array  $rawDay  The array with the raw data of a day.
     * @param  bool  $format  Format the course data for the frontend (requires parsing).
     *
     * @return array
     */
    protected function parseDay($rawDay, $format = true)
    {
        if (false == is_array($rawDay) || true == empty($rawDay))
            return [];

        $day = [];

        foreach ($rawDay as $meal_key => $meal_data) {
            if (false == is_array($meal_data) || true == empty($meal_data)) {
                $day[$meal_key] = [
                    'starter'       => null,
                    'first_course'  => null,
                    'second_course' => null,
                    'dessert'       => null,
                ];
                continue;
            }

            foreach ($meal_data as $course_key => $course_data) {
                if (false == is_array($course_data) || true == empty($course_data)) {
                    $day[$meal_key][$course_key] = null;
                    continue;
                }

                // We can only set a course per category (we are using the association field).
                if (1 != count($course_data)) {
                    $day[$meal_key][$course_key] = null;
                    continue;
                }

                if (false == array_key_exists('id', $course_data[0]) || true == empty($course_data[0]['id'])) {
                    $day[$meal_key][$course_key] = null;
                    continue;
                }

                $courseId                    = intval($course_data[0]['id']);
                $day[$meal_key][$course_key] = (false == $format) ? $courseId : $this->courseData->getData($courseId);
            }
        }

        return $day;
    }

    /**
     * Get the requested or current lunch option of the plugin.
     *
     * @param  string  $day  The day name (lowercase).
     * @param  bool  $parse  Parse the data from carbon format to the course id.
     * @param  bool  $format  Format the course data for the frontend (requires parsing).
     *
     * @return array
     */
    public function getLunch($day = '', $parse = true, $format = true)
    {
        // TODO: This function is not optimized, since it would retrieve, parse and format the whole day data,
        //  when we are just requesting a single meal.
        $day = $this->getDay($day, $parse, $format);
        if (false == is_array($day) || true == empty($day))
            return [];

        if (false == array_key_exists('lunch', $day) || true == empty($day['lunch']))
            return [];

        return $day['lunch'];
    }

    /**
     * Get the requested or current dinner option of the plugin.
     *
     * @param  string  $day  The day name (lowercase).
     * @param  bool  $parse  Parse the data from carbon format to the course id.
     * @param  bool  $format  Format the course data for the frontend (requires parsing).
     *
     * @return array
     */
    public function getDinner($day = '', $parse = true, $format = true)
    {
        // TODO: This function is not optimized, since it would retrieve, parse and format the whole day data,
        //  when we are just requesting a single meal.
        $day = $this->getDay($day, $parse, $format);
        if (false == is_array($day) || true == empty($day))
            return [];

        if (false == array_key_exists('dinner', $day) || true == empty($day['dinner']))
            return [];

        return $day['dinner'];
    }

}
