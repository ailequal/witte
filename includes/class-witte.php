<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.ailequal.com
 * @since      1.0.0
 *
 * @package    Witte
 * @subpackage Witte/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Witte
 * @subpackage Witte/includes
 * @author     ailequal <37016865+ailequal@users.noreply.github.com>
 */
class Witte {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Witte_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $plugin_name The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $version The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'WITTE_VERSION' ) ) {
			$this->version = WITTE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'witte';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_core_hooks();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Witte_Loader. Orchestrates the hooks of the plugin.
	 * - Witte_i18n. Defines internationalization functionality.
	 * - Witte_Admin. Defines all hooks for the admin area.
	 * - Witte_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for auto loading the composer packages.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . '/vendor/autoload.php';

		/**
		 * The class responsible for defining the WP-CLI commands available.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . '/includes/wp-cli.php';

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-witte-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-witte-i18n.php';

		/**
		 * The class responsible for defining all the core actions.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-witte-core.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-witte-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-witte-public.php';

		$this->loader = new Witte_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Witte_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Witte_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the core area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_core_hooks() {

		$plugin_core = new Witte_Core( $this->get_plugin_name(), $this->get_version() );

		// $this->loader->add_action( 'hook', $plugin_core, 'callback' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Witte_Admin( $this->get_plugin_name(), $this->get_version() );

//		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
//		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		$this->loader->add_action( 'admin_notices', $plugin_admin, 'activation_notice' );
		$this->loader->add_filter( 'plugin_action_links_' . WITTE_FULL_PLUGIN_NAME, $plugin_admin, 'add_action_link' );
		$this->loader->add_action( 'cmb2_admin_init', $plugin_admin, 'add_option_page' );
		$this->loader->add_action( 'init', $plugin_admin, 'add_cpt_dish', 10, 1 );
		$this->loader->add_action( 'init', $plugin_admin, 'add_taxonomy_meal', 11, 1 );
		$this->loader->add_action( 'init', $plugin_admin, 'flush_permalinks', 12, 1 );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Witte_Public( $this->get_plugin_name(), $this->get_version() );

//		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
//		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @return    string    The name of the plugin.
	 * @since     1.0.0
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @return    Witte_Loader    Orchestrates the hooks of the plugin.
	 * @since     1.0.0
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @return    string    The version number of the plugin.
	 * @since     1.0.0
	 */
	public function get_version() {
		return $this->version;
	}

}
