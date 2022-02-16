<?php

namespace Ailequal\Plugins\Witte\Traits;

/**
 * The Dependency Injection trait.
 * Add support for the dependency injection for a class.
 */
trait DependencyInjection
{

    /**
     * All the injected dependencies.
     *
     * @var array
     */
    protected $dependencies = [];

    /**
     * Get the object instance dependency.
     *
     * @param  string  $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        if (true === isset($this->dependencies[$key]))
            return $this->dependencies[$key];

        // Translators: %s is the key for the requested class instance.
        wp_die(sprintf(__("Cannot find the class instance %s.", 'witte'), $key));
    }

    /**
     * Inject an object instance as a dependency.
     * The first argument will let you choose a custom name for calling it.
     *
     * @param  string  $key  The name of the property injected.
     * @param  mixed  $dependency  The dependency instance.
     */
    public function injectDependency($key, $dependency)
    {
        $this->dependencies[$key] = $dependency;
    }

}
