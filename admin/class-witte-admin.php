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
                <p>
					<?php _e( 'Witte was successfully activated.', 'witte' ) ?>
					<?php _e( 'Now go to the option page for finalizing the configuration:', 'witte' ) ?>
                    <a href="<?php echo admin_url(); ?>admin.php?page=_witte_options"><?php _e( 'link' ) ?>.</a>
                </p>
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
		$new_links['options'] = '<a href="' . admin_url( 'admin.php?page=_witte_options' ) . '">' . __( 'Options', 'witte' ) . '</a>';

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
			'name' => __( 'The main Witte option page', 'witte' ),
			'desc' => 'Hello world.',
			'id'   => 'witte_title',
			'type' => 'title'
		) );
	}

	/**
	 * Register a custom post type called 'dish'.
	 *
	 * @see get_post_type_labels() for label keys.
	 */
	function add_cpt_dish() {
		$labels = array(
			'name'                  => _x( 'Dishes', 'Post type general name', 'witte' ),
			'singular_name'         => _x( 'Dish', 'Post type singular name', 'witte' ),
			'menu_name'             => _x( 'Dishes', 'Admin Menu text', 'witte' ),
			'name_admin_bar'        => _x( 'Dish', 'Add New on Toolbar', 'witte' ),
			'add_new'               => __( 'Add New', 'witte' ),
			'add_new_item'          => __( 'Add New Dish', 'witte' ),
			'new_item'              => __( 'New Dish', 'witte' ),
			'edit_item'             => __( 'Edit Dish', 'witte' ),
			'view_item'             => __( 'View Dish', 'witte' ),
			'all_items'             => __( 'All Dishes', 'witte' ),
			'search_items'          => __( 'Search Dishes', 'witte' ),
			'parent_item_colon'     => __( 'Parent Dishes:', 'witte' ),
			'not_found'             => __( 'No dishes found.', 'witte' ),
			'not_found_in_trash'    => __( 'No dishes found in Trash.', 'witte' ),
			'featured_image'        => _x( 'Dish Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'witte' ),
			'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'witte' ),
			'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'witte' ),
			'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'witte' ),
			'archives'              => _x( 'Dish archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'witte' ),
			'insert_into_item'      => _x( 'Insert into dish', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'witte' ),
			'uploaded_to_this_item' => _x( 'Uploaded to this dish', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'witte' ),
			'filter_items_list'     => _x( 'Filter dishes list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'witte' ),
			'items_list_navigation' => _x( 'Dishes list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'witte' ),
			'items_list'            => _x( 'Dishes list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'witte' ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => false,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'dish' ),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
		);

		register_post_type( 'dish', $args );
	}

	/**
	 * Create a new taxonomy called brand.
	 * Its slug depends on the user input from the options panel.
	 *
	 * @see register_post_type() for registering custom post types.
	 */
	public function add_taxonomy_meal() {
		$labels = array(
			'name'                       => _x( 'Meals', 'Taxonomy general name', 'witte' ),
			'singular_name'              => _x( 'Meal', 'Taxonomy singular name', 'witte' ),
			'search_items'               => __( 'Search Meals', 'witte' ),
			'popular_items'              => __( 'Popular Meals', 'witte' ),
			'all_items'                  => __( 'All Meals', 'witte' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Meal', 'witte' ),
			'update_item'                => __( 'Update Meal', 'witte' ),
			'add_new_item'               => __( 'Add New Meal', 'witte' ),
			'new_item_name'              => __( 'New Meal Name', 'witte' ),
			'separate_items_with_commas' => __( 'Separate meals with commas', 'witte' ),
			'add_or_remove_items'        => __( 'Add or remove meals', 'witte' ),
			'choose_from_most_used'      => __( 'Choose from the most used meals', 'witte' ),
			'not_found'                  => __( 'No meals found.', 'witte' ),
			'menu_name'                  => __( 'Meals', 'witte' ),
		);

		$args = array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
//			'update_count_callback' => '_update_post_term_count',
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'meal' ),
		);

		register_taxonomy( 'meal', 'dish', $args );
	}

	/**
	 * When the plugin is activated a new custom post type is registered, so the permalinks must be flushed
	 * to allow the visualization of the new taxonomy in the frontend.
	 */
	public function flush_permalinks() {
		if ( get_transient( '_witte_activation_notice' ) ) {
			flush_rewrite_rules();
		}
	}

}
