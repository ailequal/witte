<?php

namespace Ailequal\Plugins\Witte\Utilities;

use Ailequal\Plugins\Witte\Traits\Singleton;

/**
 * The Resource class.
 * The helper class for all the plugin resources.
 */
class Resource
{

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
    public function getViewPath($view)
    {
        return $this->getViewsPath().$view.'.php';
    }

    /**
     * Get the path for the views.
     *
     * @return string
     */
    public function getViewsPath()
    {
        return WITTE_BASE_PATH.'resources/views/';
    }

    /**
     * Get the path for a specific style asset.
     *
     * @param  string  $view
     *
     * @return string
     */
    public function getStylePath($view)
    {
        return $this->getStylesPath().$view.'.css';
    }

    /**
     * Get the path for the styles.
     *
     * @return string
     */
    public function getStylesPath()
    {
        return WITTE_BASE_URL.'resources/css/';
    }

    /**
     * Get the path for a specific style asset.
     *
     * @param  string  $view
     *
     * @return string
     */
    public function getScriptPath($view)
    {
        return $this->getScriptsPath().$view.'.js';
    }

    /**
     * Get the path for the styles.
     *
     * @return string
     */
    public function getScriptsPath()
    {
        return WITTE_BASE_URL.'resources/js/';
    }

}
