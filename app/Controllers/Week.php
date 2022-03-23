<?php

namespace Ailequal\Plugins\Witte\Controllers;

use Ailequal\Plugins\Witte\Traits\Singleton;

/**
 * The Week plugin class.
 * Define the days fo the week.
 */
class Week
{

    use Singleton;

    /**
     * The days default.
     *
     * @var null|array $daysDefault
     */
    protected $daysDefault = null;

    /**
     * The days.
     *
     * @var null|array $days
     */
    protected $days = null;

    /**
     * Get the days default (as key => label).
     *
     * @return array
     */
    protected function getDaysDefault()
    {
        $daysDefault = $this->daysDefault;
        if (false === is_null($daysDefault))
            return $daysDefault;

        $daysDefault = [
            'monday'    => __('Monday', 'witte'),
            'tuesday'   => __('Tuesday', 'witte'),
            'wednesday' => __('Wednesday', 'witte'),
            'thursday'  => __('Thursday', 'witte'),
            'friday'    => __('Friday', 'witte'),
            'saturday'  => __('Saturday', 'witte'),
            'sunday'    => __('Sunday', 'witte')
        ];

        $this->daysDefault = $daysDefault;

        return $daysDefault;
    }

    /**
     * Get the days (as key => label).
     *
     * @return array
     */
    public function getDays()
    {
        $days = $this->days;
        if (false === is_null($days))
            return $days;

        // TODO: Rearrange the week days based on the fist day of the week setting.
        $daysDefault = $this->getDaysDefault();
        $days        = $daysDefault;
        if (false == is_array($days))
            $days = $daysDefault;

        $this->days = $days;

        return $days;
    }

    /**
     * Get the full name of the current day of the week.
     *
     * @return string
     */
    public function getToday()
    {
        // TODO: Test and decide if we should instead use the current_time() function from WordPress itself,
        //  which might be more accurate, since it should reflect the current timezone settings in the backend.
        $day = date("l", time()); // It should never return false, but still check it.

        return (false == $day) ? 'monday' : strtolower($day);
    }

}
