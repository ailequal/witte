<?php

namespace Ailequal\Plugins\Witte\Controllers\OptionPage\WeekPlan;

use Ailequal\Plugins\Witte\Controllers\Week;
use Ailequal\Plugins\Witte\Traits\DependencyInjection;
use Ailequal\Plugins\Witte\Traits\Singleton;

/**
 * The Data plugin class for the week plan.
 * Define the methods for retrieving the plugin week plan data.
 *
 * All the dependencies injected as magic methods:
 * @property Week $week
 */
class Data
{

    // TODO: Consider adding the short-circuits hooks for the plugin week data.
    // TODO: What kind of data to we really need from this class??
    //  e.g. The day complete schedule, only the lunch, only the first course of the lunch...

    use Singleton;
    use DependencyInjection;

    /**
     * Get the requested day option of the plugin.
     *
     * @param  string  $day
     *
     * @return array
     */
    public function getDay($day = '')
    {
        // Without passing a specific day, automatically retrieve the current day based on the date.
        // TODO: Test and decide if we should instead use the current_time() function from WordPress itself,
        //  which might be more accurate, since it should reflect the current timezone settings in the backend.
        if (false == is_string($day) || true == empty($day)) {
            $day = date("l", time()); // It should never return false, but still check it.
            $day = (false == $day) ? 'monday' : strtolower($day);
        }

        // TODO: Retrieve the key from the appropriate class.
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

        return $this->parseDay($rawDay);
    }

    /**
     * Parse the raw day option of the plugin.
     *
     * @param $rawDay
     *
     * @return array
     */
    protected function parseDay($rawDay)
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

                $day[$meal_key][$course_key] = intval($course_data[0]['id']);
            }
        }

        return $day;
    }

}
