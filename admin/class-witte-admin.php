<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.ailequal.com
 * @since      1.0.0
 *
 * @package    Witte
 * @subpackage Witte/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Witte
 * @subpackage Witte/admin
 * @author     ailequal <37016865+ailequal@users.noreply.github.com>
 */
class Witte_Admin {

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
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Witte_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Witte_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/witte-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Witte_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Witte_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/witte-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Prints the admin notice when the plugin is activated.
	 * It uses a transient for establishing whether to
	 * display it or not.
	 */
	public function activation_notice() {
		// Check transient, if available display notice.
		if ( get_transient( '_witte_activation_notice' ) ) {
			?>
            <div class="updated notice is-dismissible">
                <p>Witte e' stato correttamente attivato. Andare nel pannello delle <a
                            href="<?php echo admin_url(); ?>admin.php?page=_witte_options">opzioni</a> per
                    eseguire la configurazione.</p>
            </div>
			<?php
			// Delete transient, only display this notice once.
			delete_transient( '_witte_activation_notice' );
		}
	}

	/**
	 * Add action links to the plugin.
	 *
	 * @param array $links An array of plugin action links.
	 *
	 * @return mixed
	 */
	public function add_action_link( array $links ) {
		$new_links['options'] = '<a href="' . admin_url( 'admin.php?page=_witte_options' ) . '">Opzioni</a>';

		return array_merge( $new_links, $links );
	}

	/**
	 * Adding the main option page for the plugin.
	 */
	public function add_option_page() {
		// Initialize cmb2 box.
		$options_cmb2 = new_cmb2_box( array(
			'id'           => 'witte_options',
			'title'        => __( 'Witte', 'witte' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => '_witte_options',
			'capability'   => 'manage_options',
//			'icon_url'     => WITTE_BASEURL . '/admin/img/witte.svg',
			'position'     => 100
		) );

		// Add main description.
		$options_cmb2->add_field( array(
			'name' => 'The main Witte page',
			'desc' => 'Hello there.',
			'id'   => 'witte_title',
			'type' => 'title'
		) );
	}

	/**
	 * When the plugin is activated a new taxonomy is registered, so the permalinks must be flushed
	 * to allow the visualization of the new taxonomy in the frontend.
	 */
	public function flush_permalinks() {
		if ( get_transient( '_witte_activation_notice' ) ) {
			flush_rewrite_rules();
		}
	}

	/**
	 * Create a new taxonomy called brand.
	 * Its slug depends on the user input from the options panel.
	 */
	public function create_taxonomy_dish() {
//		// Add the dish taxonomy (not hierarchical, like tags).
//		$labels = array(
//			'name'                       => _x( 'Brand', 'taxonomy general name', 'witte' ),
//			'singular_name'              => _x( 'Brand', 'taxonomy singular name', 'witte' ),
//			'search_items'               => __( 'Cerca Brand', 'witte' ),
//			'popular_items'              => __( 'Brand popolari', 'witte' ),
//			'all_items'                  => __( 'Tutti i Brands', 'witte' ),
//			'parent_item'                => null,
//			'parent_item_colon'          => null,
//			'edit_item'                  => __( 'Modifica Brand', 'witte' ),
//			'update_item'                => __( 'Aggiorna Brand', 'witte' ),
//			'add_new_item'               => __( 'Aggiungi un nuovo Brand', 'witte' ),
//			'new_item_name'              => __( 'Nome nuovo Brand', 'witte' ),
//			'separate_items_with_commas' => __( 'Separa i Brand con la virgola', 'witte' ),
//			'add_or_remove_items'        => __( 'Aggiungi o rimuovi i Brand', 'witte' ),
//			'choose_from_most_used'      => __( 'Scegli tra i Brand piu\' usati', 'witte' ),
//			'not_found'                  => __( 'Nessun Brand trovato.', 'witte' ),
//			'menu_name'                  => __( 'Brand', 'witte' ),
//		);
//
//		$args = array(
//			'hierarchical' => false,
//			'labels'       => $labels,
//			'public'       => true,
//			'show_ui'      => true,
//			'rewrite'      => array( 'slug' => 'dish' ),
//		);
//
//		register_taxonomy( 'dish', 'product', $args );
	}

}
