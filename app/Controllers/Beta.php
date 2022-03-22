<?php

namespace Ailequal\Plugins\Witte\Controllers;

use Ailequal\Plugins\Witte\Abstracts\Hook;
use Ailequal\Plugins\Witte\Models\ExecutionTime;
use Ailequal\Plugins\Witte\Utilities\Log;
use Ailequal\Plugins\Witte\Utilities\Resource;
use Ailequal\Plugins\Witte\Traits\DependencyInjection;
use Ailequal\Plugins\Witte\Traits\Singleton;

/**
 * The Beta plugin class.
 * Define the beta example functionality.
 *
 * All the dependencies injected as magic methods:
 * @property Alpha $alpha
 * @property Resource $resource
 * @property Log $log
 * @property OptionPage\Option\Data $optionData
 * @property OptionPage\WeekPLan\Data $weekPlanData
 * @property CustomPostType\Course\Data $courseData
 */
class Beta extends Hook
{

    use Singleton;
    use DependencyInjection;

    /**
     * Loads all the hooks related to this class.
     */
    public function hooks()
    {
        add_action('admin_enqueue_scripts', [$this, 'backendEnqueue']);
        add_action('wp_enqueue_scripts', [$this, 'frontendEnqueue']);
        add_action('wp_footer', [$this, 'wpFooterCallback']);
    }

    /**
     * Register the assets for the backend.
     */
    public function backendEnqueue() { }

    /**
     * Register the assets for the frontend.
     */
    public function frontendEnqueue()
    {
        wp_enqueue_style('', $this->resource->getStylePath('style'), [], WITTE_VERSION, 'all');
        wp_enqueue_script('', $this->resource->getScriptPath('script'), ['jquery'], WITTE_VERSION, true);
    }

    /**
     * wpFooterCallback()
     */
    public function wpFooterCallback()
    {
        // Lot time execution for this method.
        $executionTime = new ExecutionTime($this->log);
        $executionTime->start();

        // Call method from an injected class.
        echo '<br>=== DEPENDENCY INJECTION ===<br>';
        echo $this->alpha->alpha();
        echo '<br>============================<br>';

        // Always set the domain as a string to allow the parser to actually catch the strings.
        echo '<br>=== TRANSLATED STRING ===<br>';
        _e('Hello, dear user!', 'witte');
        echo '<br>========================<br>';

        // Get a view template and print it.
        echo '<br>=== View ===<br>';
        $this->resource->theView('template', ['time' => time()]);
        echo '<br>============<br>';

        // Log some sample data.
//        $this->log->log(['a' => 'b', 'c' => 'd', 'e' => time()]);

        // Trying to retrieve stored data from Carbon Fields.
        $witteLanguages     = $this->optionData->getLanguages();
        $dayPlan            = $this->weekPlanData->getDay('monday');
        $courseTranslations = $this->courseData->getTranslations(5);
        $courseTranslation  = $this->courseData->getTranslation(5, 'it');

        echo '<pre>';
        var_dump($witteLanguages);
        var_dump($dayPlan);
        var_dump($courseTranslations);
        var_dump($courseTranslation);
        echo '</pre>';

        // Lot time execution for this method.
        $executionTime->end();
        echo $executionTime->getRunTime(true);
    }

}
