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

        // Add multiple tab support (it's always the same page) and inject all the fields inside the page.
        $weekPlanPage->add_tab(__('Monday', 'witte'), [
            $this->getLaunchDescription(),
            $this->getAssociation('launch_starter', __('Starter', 'witte')),
            $this->getAssociation('launch_first_course', __('First course', 'witte')),
            $this->getAssociation('launch_second_course', __('Second course', 'witte')),
            $this->getAssociation('launch_dessert', __('Dessert', 'witte')),
            Field::make('separator', 'separator', '—'),
            $this->getDinnerDescription(),
            $this->getAssociation('dinner_starter', __('Starter', 'witte')),
            $this->getAssociation('dinner_first_course', __('First course', 'witte')),
            $this->getAssociation('dinner_second_course', __('Second course', 'witte')),
            $this->getAssociation('dinner_dessert', __('Dessert', 'witte')),
        ]);
        $weekPlanPage->add_tab(__('Tuesday', 'witte'), [
            Field::make('text', 'crb_first_name', 'First Name'),
            Field::make('text', 'crb_last_name', 'Last Name')
        ]);
    }

    /**
     * Get the launch description html field.
     *
     * @return Field\Html_Field
     */
    protected function getLaunchDescription()
    {
        $launchDescription = Field::make('html', 'launch_description');
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
     * @return Field\Html_Field
     */
    protected function getDinnerDescription()
    {
        $dinnerDescription = Field::make('html', 'dinner_description');
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

}
