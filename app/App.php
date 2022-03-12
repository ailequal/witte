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
        // TODO: Consider a cleaner way to define the dependencies, maybe from inside the class when it's initialized?
        //  Or maybe not since it defeat the purpose of the dependency injection.

        Utilities\Activator::getInstance()->init();
        Utilities\Deactivator::getInstance()->init();
        Utilities\I18n::getInstance()->hooks();
        Utilities\CarbonFields::getInstance()->hooks();

        Controllers\Alpha::getInstance()->hooks();
        Controllers\Beta::getInstance()->hooks();

        Controllers\Option\Page::getInstance()->hooks();

        Controllers\CustomPostType\Course\Course::getInstance()->hooks();
        Controllers\CustomPostType\Course\MetaBox::getInstance()->hooks();
        Controllers\CustomPostType\Course\Column::getInstance()->hooks();

        Controllers\Taxonomy\CourseCat::getInstance()->hooks();
        Controllers\Taxonomy\CourseTag::getInstance()->hooks();

        Commands\Gamma::getInstance()->hooks();
        Commands\Importer::getInstance()->hooks();
        Commands\Exporter::getInstance()->hooks();

        // TODO: Add full rest api (required authentication?).
        // TODO: Optimize autoloader for production.
        // TODO: Consider replacing Composer with a manual autoload functionality?
        // TODO: Extract the relative plugin skeleton.
        // TODO: Test and build with "wp scaffold plugin" and "wp dist-archive".
    }

    /**
     * Register all the needed dependencies for the plugin classes.
     */
    private function dependencies()
    {
        Controllers\Beta::getInstance()->injectDependency('alpha', Controllers\Alpha::getInstance());
        Controllers\Beta::getInstance()->injectDependency('resource', Utilities\Resource::getInstance());
        Controllers\Beta::getInstance()->injectDependency('log', Utilities\Log::getInstance());
        Controllers\Beta::getInstance()->injectDependency('optionData', Controllers\Option\Data::getInstance());

        Controllers\Option\Page::getInstance()->injectDependency('language', Controllers\Language::getInstance());
        Controllers\Option\Data::getInstance()->injectDependency('language', Controllers\Language::getInstance());

        Controllers\CustomPostType\Course\MetaBox::getInstance()->injectDependency('data', Controllers\Option\Data::getInstance());

        Commands\Gamma::getInstance()->injectDependency('alpha', Controllers\Alpha::getInstance());
    }

}
