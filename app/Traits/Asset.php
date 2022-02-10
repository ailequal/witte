<?php

namespace Ailequal\Plugins\Witte\Traits;

/**
 * The Asset trait.
 * Add support for the assets for a class.
 */
trait Asset
{

    // TODO: Convert into utility Class as well.

    /**
     * Get the path for a specific style asset.
     *
     * @param  string  $view
     *
     * @return string
     */
    protected function getStylePath($view)
    {
        return $this->getStylesPath().$view.'.css';
    }

    /**
     * Get the path for the styles.
     *
     * @return string
     */
    protected function getStylesPath()
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
    protected function getScriptPath($view)
    {
        return $this->getScriptsPath().$view.'.js';
    }

    /**
     * Get the path for the styles.
     *
     * @return string
     */
    protected function getScriptsPath()
    {
        return WITTE_BASE_URL.'resources/js/';
    }

}
