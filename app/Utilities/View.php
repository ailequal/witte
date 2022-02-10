<?php

namespace Ailequal\Plugins\Witte\Utilities;

use Ailequal\Plugins\Witte\Traits\Singleton;

/**
 * The View class.
 * Define the views methods.
 */
class View
{

    // TODO: Rename properly the functions??

    use Singleton;

    /**
     * Echo a view.
     *
     * @param  string  $view
     * @param  array  $assocArgs
     */
    public function theView($view, $assocArgs = [])
    {
        echo $this->getView($view, $assocArgs);
    }

    /**
     * Get a view as a variable.
     *
     * @param  string  $view
     * @param  array  $assocArgs
     *
     * @return string
     */
    public function getView($view, $assocArgs = [])
    {
        $view_path = $this->getViewPath($view);
        if (false == file_exists($view_path))
            return '';

        extract($assocArgs);

        ob_start();
        include $view_path;

        return ob_get_clean();
    }

    /**
     * Get the path for a specific view.
     *
     * @param  string  $view
     *
     * @return string
     */
    protected function getViewPath($view)
    {
        return $this->getViewsPath().$view.'.php';
    }

    /**
     * Get the path for the views.
     *
     * @return string
     */
    protected function getViewsPath()
    {
        return WITTE_BASE_PATH.'resources/views/';
    }

}
