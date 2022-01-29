<?php

namespace Ailequal\Plugins\Witte\Traits;

/**
 * The Singleton trait.
 * Convert a class into a singleton.
 */
trait Singleton
{

    /**
     * The class instance.
     *
     * @var self|null $instance
     */
    private static $instance = null;

    /**
     * The constructor function.
     * It's private to prevent initialization from outside.
     */
    private function __construct() { }

    /**
     * Get the current class instance,
     * or create a new one if it doesn't already exist.
     *
     * @return self
     */
    public static function getInstance()
    {
        // TODO: The IDE can't figure out which class is being returned exactly.
        //  This will cause the suggestion to be a little crazy.
        if (true === is_null(self::$instance))
            self::$instance = new self();

        return self::$instance;
    }

}
