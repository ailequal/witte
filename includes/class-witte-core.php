<?php

/**
 * The core-specific functionality of the plugin.
 *
 * @link       https://www.ailequal.com
 * @since      1.0.0
 *
 * @package    Witte
 * @subpackage Witte/includes
 */

/**
 * The core-specific functionality of the plugin.
 *
 * Defines the plugin name, version.
 *
 * @package    Witte
 * @subpackage Witte/includes
 * @author     ailequal <37016865+ailequal@users.noreply.github.com>
 */
class Witte_Core {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version The version of this plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Retrieve the options of the plugin.
	 *
	 * @return array
	 */
	public static function get_plugin_options() {
		$default = '';

		$plugin_options = get_option( '_witte_options', $default );

		if ( true === empty( $plugin_options ) ) {
			$plugin_options = '';
		}

		return $plugin_options;
	}

}
