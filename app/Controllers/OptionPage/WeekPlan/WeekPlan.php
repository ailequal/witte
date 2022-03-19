<?php

namespace Ailequal\Plugins\Witte\Controllers\OptionPage\WeekPlan;

use Ailequal\Plugins\Witte\Abstracts\Hook;
use Ailequal\Plugins\Witte\Traits\Singleton;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * The WeekPlan plugin class.
 * Register the plugin week plan page.
 */
class WeekPlan extends Hook
{

    // TODO: Add a page just for showing the current status of today and the next day in two tabs??

    use Singleton;

    /**
     * Get the week plan error message.
     *
     * @return string
     */
    protected function getWeekPlanError()
    {
        return __("Cannot generate the week plan page with Carbon Fields.", 'witte');
    }

    /**
     * Get the field error message.
     *
     * @return string
     */
    protected function getFieldError()
    {
        return __("Cannot generate a field with Carbon Fields.", 'witte');
    }

    /**
     * Loads all the hooks related to this class.
     */
    public function hooks()
    {
        add_action('carbon_fields_register_fields', [$this, 'registerWeekPlanPage']);
    }

    /**
     * Register the week plan page and its related fields.
     */
    public function registerWeekPlanPage()
    {
        // Register the new page.
        $weekPlanPage = Container::make('theme_options', __('Week plan', 'witte'));
        if (false == is_a($weekPlanPage, '\Carbon_Fields\Container\Theme_Options_Container'))
            wp_die($this->getWeekPlanError());

        $weekPlanPage->set_page_parent('witte');
        $weekPlanPage->set_page_file('witte_week_plan'); // Set the custom options page slug.
//        $options_page->set_icon('icon.png'); // TODO: Add a custom icon for the plugin options.

        // Add a tab for each week day and inject all the dynamic fields.
        $days = [
            'monday'    => __('Monday', 'witte'),
            'tuesday'   => __('Tuesday', 'witte'),
            'wednesday' => __('Wednesday', 'witte'),
            'thursday'  => __('Thursday', 'witte'),
            'friday'    => __('Friday', 'witte'),
            'saturday'  => __('Saturday', 'witte'),
            'sunday'    => __('Sunday', 'witte')
        ];
        foreach ($days as $key => $label) {
            $weekPlanPage->add_tab($label, [
                $this->getDayDescription($key, $label),
                $this->getLaunchDescription($key),
                $this->getAssociation($key.'_launch_starter', __('Starter', 'witte')),
                $this->getAssociation($key.'_launch_first_course', __('First course', 'witte')),
                $this->getAssociation($key.'_launch_second_course', __('Second course', 'witte')),
                $this->getAssociation($key.'_launch_dessert', __('Dessert', 'witte')),
                $this->getSeparator($key),
                $this->getDinnerDescription($key),
                $this->getAssociation($key.'_dinner_starter', __('Starter', 'witte')),
                $this->getAssociation($key.'_dinner_first_course', __('First course', 'witte')),
                $this->getAssociation($key.'_dinner_second_course', __('Second course', 'witte')),
                $this->getAssociation($key.'_dinner_dessert', __('Dessert', 'witte')),
            ]);
        }
    }

    /**
     * Get the launch description html field.
     *
     * @param  string  $key
     * @param  string  $label
     *
     * @return Field\Html_Field
     */
    protected function getDayDescription($key, $label)
    {
        $dayDescription = Field::make('html', $key.'_day_description');
        if (false == is_a($dayDescription, '\Carbon_Fields\Field\Html_Field'))
            wp_die($this->getFieldError());

        $dayDescription->set_html(sprintf(
            '<h2 style="text-align: center; font-size: 20px; font-weight: bold;">%s</h2>',
            $label
        ));

        return $dayDescription;
    }

    /**
     * Get the launch description html field.
     *
     * @param  string  $key
     *
     * @return Field\Html_Field
     */
    protected function getLaunchDescription($key)
    {
        $launchDescription = Field::make('html', $key.'_launch_description');
        if (false == is_a($launchDescription, '\Carbon_Fields\Field\Html_Field'))
            wp_die($this->getFieldError());

        $launchDescription->set_html(sprintf(
            '<h2 style="font-size: 18px; font-weight: bold;">%s</h2>',
            __('Launch', 'witte')
        ));

        return $launchDescription;
    }

    /**
     * Get the dinner description html field.
     *
     * @param  string  $key
     *
     * @return Field\Html_Field
     */
    protected function getDinnerDescription($key)
    {
        $dinnerDescription = Field::make('html', $key.'_dinner_description');
        if (false == is_a($dinnerDescription, '\Carbon_Fields\Field\Html_Field'))
            wp_die($this->getFieldError());

        $dinnerDescription->set_html(sprintf(
            '<h2 style="font-size: 18px; font-weight: bold;">%s</h2>',
            __('Dinner', 'witte')
        ));

        return $dinnerDescription;
    }

    /**
     * Get the association field.
     *
     * @param  string  $key
     * @param  string  $label
     *
     * @return Field\Association_Field
     */
    protected function getAssociation($key, $label = 'Association')
    {
        $association = Field::make('association', $key, $label);
        if (false == is_a($association, '\Carbon_Fields\Field\Association_Field'))
            wp_die($this->getFieldError());

        // TODO: We should set the types with a specific taxonomy term for the query. In order to do so,
        //  we need to create a user interface for mapping each course category taxonomy term with
        //  its related field association. e.g. taxonomy course_cat => term starter => field starter
        //  There is no other easy way, since we cannot create multiple default taxonomy terms, just one per taxonomy...
        //  For now we'll just keep querying all the available courses every time.
        $association->set_types([
            [
                'type'      => 'post',
                'post_type' => 'course',
            ]
        ]);
        $association->set_min(1);
        $association->set_max(1);
        $association->set_duplicates_allowed(false);
        $association->set_items_per_page(1);

        return $association;
    }

    /**
     * Get the separator field.
     *
     * @param  string  $key
     *
     * @return Field\Separator_Field
     */
    protected function getSeparator($key)
    {
        $separator = Field::make('separator', $key.'_separator', '—');
        if (false == is_a($separator, '\Carbon_Fields\Field\Separator_Field'))
            wp_die($this->getFieldError());

        return $separator;
    }

}
