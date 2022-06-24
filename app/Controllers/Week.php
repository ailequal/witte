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
        // We do not rely on wp_date() since it would automatically translate the day label into the current
        // WordPress active language. That's why we manually add the offset. Both date() and time() always handle the
        // unix timestamp (UTC format), no matter how the server is configured.
        $day = date("l", time() + $this->getTimezoneOffset()); // It should never return false, but still check it.

        return (false == $day) ? 'monday' : strtolower($day);
    }

    /**
     * Get timezone offset in seconds.
     * This function is copied from WooCommerce 6.6.1.
     *
     * @return float
     *
     * @link https://github.com/woocommerce/woocommerce/blob/trunk/plugins/woocommerce/includes/wc-formatting-functions.php#L794
     */
    public function getTimezoneOffset()
    {
        $timezone = get_option('timezone_string');

        if ($timezone) {
            $timezone_object = new \DateTimeZone($timezone);

            return $timezone_object->getOffset(new \DateTime('now'));
        } else {
            return floatval(get_option('gmt_offset', 0)) * HOUR_IN_SECONDS;
        }
    }

}
