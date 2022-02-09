<?php

namespace Ailequal\Plugins\Witte\Controllers;

use Ailequal\Plugins\Witte\Traits\DependencyInjection;
use Ailequal\Plugins\Witte\Traits\Singleton;
use Ailequal\Plugins\Witte\Traits\View;

/**
 * The Beta plugin class.
 * Define the beta example functionality.
 *
 * All the dependencies injected as magic methods:
 * @property Alpha $alpha
 */
class Beta
{

    use Singleton;
    use DependencyInjection;
    use View;

    /**
     * Loads all the hooks related to this class.
     */
    public function hooks()
    {
        add_action('wp_footer', [$this, 'wpFooterCallback']);

        // TODO: Add example for enqueueing css and js (both frontend and backend).
    }

    /**
     * wpFooterCallback()
     */
    public function wpFooterCallback()
    {
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
        $this->theView('template', ['time' => time()]);
        echo '<br>============<br>';
    }

}
