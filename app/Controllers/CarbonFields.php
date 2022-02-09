<?php

namespace Ailequal\Plugins\Witte\Controllers;

use Ailequal\Plugins\Witte\Traits\Singleton;
use Carbon_Fields\Carbon_Fields;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * The Carbon Fields plugin class.
 * Loads the Carbon Fields library from composer.
 */
class CarbonFields
{

    use Singleton;

    /**
     * Loads all the hooks related to this class.
     */
    public function hooks()
    {
        add_action('after_setup_theme', [$this, 'init']);
        add_action('carbon_fields_register_fields', [$this, 'crb_attach_theme_options']);
    }

    /**
     * Loads the Carbon Fields library.
     */
    public function init()
    {
        Carbon_Fields::boot();
    }

    public function crb_attach_theme_options()
    {
        Container::make('theme_options', __('Theme Options'))
                 ->add_fields([Field::make('text', 'crb_text', 'Text Field')]);
    }

}
