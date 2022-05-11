<?php

namespace Ailequal\Plugins\Witte;

use Ailequal\Plugins\Witte\Traits\Singleton;

/**
 * The App plugin class.
 * All the plugin logic will be handled starting from this class.
 */
class App
{

    use Singleton;

    /**
     * Initialize the class.
     */
    public function init()
    {
        $this->classes();
        $this->dependencies();
    }

    /**
     * Register all the plugin classes
     * (and optionally their relative hooks or any other functionalities).
     */
    private function classes()
    {
        // TODO: Create three separate methods: utilities(), controllers() and commands().
        //  The classes() won't exist anymore, but we will still have a single dependencies()??
        // TODO: All classes should just fire init(), and internally automatically handle hooks, if needed.

        Utilities\Activator::getInstance()->init();
        Utilities\Deactivator::getInstance()->init();
        Utilities\I18n::getInstance()->hooks();
        Utilities\CarbonFields::getInstance()->hooks();

        // TODO: Clean these debugging classes (Alpha, Beta, Gamma...)?!
//        Controllers\Alpha::getInstance()->hooks();
//        Controllers\Beta::getInstance()->hooks();

        Controllers\OptionPage\Option\Option::getInstance()->hooks();
        Controllers\OptionPage\Option\Data::getInstance()->hooks();
        Controllers\OptionPage\WeekPlan\WeekPlan::getInstance()->hooks();
        Controllers\OptionPage\WeekPlan\Data::getInstance()->hooks();

        Controllers\CustomPostType\Course\Course::getInstance()->hooks();
        Controllers\CustomPostType\Course\MetaBox::getInstance()->hooks();
        Controllers\CustomPostType\Course\Column::getInstance()->hooks();

        Controllers\Taxonomy\CourseCat::getInstance()->hooks();
        Controllers\Taxonomy\CourseTag::getInstance()->hooks();

        Controllers\Template::getInstance()->hooks();

//        Commands\Gamma::getInstance()->hooks();
//        Commands\Importer::getInstance()->hooks();
//        Commands\Exporter::getInstance()->hooks();

        // TODO: Add full rest api (required authentication?). It's mostly for fun.
        // TODO: Consider replacing Composer with a manual autoload functionality (see most famous plugins setup)? How will I handle Carbon Fields then?
        // TODO: Extract the relative plugin skeleton.
        // TODO: Test and build with "wp scaffold plugin" and "wp dist-archive".
        // TODO: Add custom option template for primary, secondary colors.
        // TODO: Update custom option template inputs for the text with HTML editor.
    }

    /**
     * Register all the needed dependencies for the plugin classes.
     */
    private function dependencies()
    {
//        Controllers\Beta::getInstance()->injectDependency('alpha', Controllers\Alpha::getInstance());
//        Controllers\Beta::getInstance()->injectDependency('resource', Utilities\Resource::getInstance());
//        Controllers\Beta::getInstance()->injectDependency('log', Utilities\Log::getInstance());
//        Controllers\Beta::getInstance()->injectDependency('optionData', Controllers\OptionPage\Option\Data::getInstance());
//        Controllers\Beta::getInstance()->injectDependency('weekPlanData', Controllers\OptionPage\WeekPlan\Data::getInstance());
//        Controllers\Beta::getInstance()->injectDependency('courseData', Controllers\CustomPostType\Course\Data::getInstance());

        Controllers\OptionPage\Option\Option::getInstance()->injectDependency('language', Controllers\Language::getInstance());
        Controllers\OptionPage\Option\Data::getInstance()->injectDependency('language', Controllers\Language::getInstance());

        Controllers\OptionPage\WeekPlan\WeekPlan::getInstance()->injectDependency('week', Controllers\Week::getInstance());
        Controllers\OptionPage\WeekPlan\Data::getInstance()->injectDependency('week', Controllers\Week::getInstance());
        Controllers\OptionPage\WeekPlan\Data::getInstance()->injectDependency('courseData', Controllers\CustomPostType\Course\Data::getInstance());

        Controllers\CustomPostType\Course\Column::getInstance()->injectDependency('courseData', Controllers\CustomPostType\Course\Data::getInstance());
        Controllers\CustomPostType\Course\MetaBox::getInstance()->injectDependency('optionData', Controllers\OptionPage\Option\Data::getInstance());
        Controllers\CustomPostType\Course\Data::getInstance()->injectDependency('optionData', Controllers\OptionPage\Option\Data::getInstance());

        Controllers\Template::getInstance()->injectDependency('resource', Utilities\Resource::getInstance());

//        Commands\Gamma::getInstance()->injectDependency('alpha', Controllers\Alpha::getInstance());
    }

}
