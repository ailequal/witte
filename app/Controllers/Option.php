<?php

namespace Ailequal\Plugins\Witte\Controllers;

use Ailequal\Plugins\Witte\Abstracts\Hook;
use Ailequal\Plugins\Witte\Traits\Singleton;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * The Option plugin class.
 * Define the option functionality.
 */
class Option extends Hook
{

    use Singleton;

    /**
     * Loads all the hooks related to this class.
     */
    public function hooks()
    {
        add_action('carbon_fields_register_fields', [$this, 'crb_attach_theme_options']);
    }

    /**
     * crb_attach_theme_options()
     */
    public function crb_attach_theme_options()
    {
        Container::make('theme_options', __('Theme Options'))
                 ->add_fields([
                     Field::make('text', 'crb_text_1', 'Text Field 1'), // empty or string
                     Field::make('text', 'crb_text_2', 'Text Field 2'),
                     Field::make('text', 'crb_text_3', 'Text Field 3'),
                     Field::make('text', 'crb_text_4', 'Text Field 4')
                 ]);
    }

}
