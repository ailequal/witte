<?php

namespace Ailequal\Plugins\Witte\Controllers\Taxonomy;

use Ailequal\Plugins\Witte\Abstracts\Hook;
use Ailequal\Plugins\Witte\Traits\Singleton;

/**
 * The Course Cat plugin class.
 * Define the category taxonomy for the course custom post type.
 */
class CourseCat extends Hook
{

    use Singleton;

    /**
     * The taxonomy slug.
     *
     * @var string
     */
    protected $slug = 'course_cat';

    /**
     * Loads all the hooks related to this class.
     */
    public function hooks()
    {
        add_action('init', [$this, 'register']);
    }

    /**
     * Register the taxonomy.
     */
    public function register()
    {
        $labels = [
            'name'                       => _x('Categories', 'Taxonomy General Name', 'witte'),
            'singular_name'              => _x('Category', 'Taxonomy Singular Name', 'witte'),
            'menu_name'                  => __('Category', 'witte'),
            'all_items'                  => __('All Categories', 'witte'),
            'parent_item'                => __('Parent Category', 'witte'),
            'parent_item_colon'          => __('Parent Category:', 'witte'),
            'new_item_name'              => __('New Category Name', 'witte'),
            'add_new_item'               => __('Add New Category', 'witte'),
            'edit_item'                  => __('Edit Category', 'witte'),
            'update_item'                => __('Update Category', 'witte'),
            'view_item'                  => __('View Category', 'witte'),
            'separate_items_with_commas' => __('Separate categories with commas', 'witte'),
            'add_or_remove_items'        => __('Add or remove categories', 'witte'),
            'choose_from_most_used'      => __('Choose from the most used', 'witte'),
            'popular_items'              => __('Popular Categories', 'witte'),
            'search_items'               => __('Search Categories', 'witte'),
            'not_found'                  => __('Not Found', 'witte'),
            'no_terms'                   => __('No categories', 'witte'),
            'items_list'                 => __('Categories list', 'witte'),
            'items_list_navigation'      => __('Categories list navigation', 'witte'),
        ];

        $args = [
            'labels'            => $labels,
            'hierarchical'      => true,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud'     => true,
        ];

        register_taxonomy($this->slug, ['course'], $args); // TODO: Inject slugs from the relative class.
    }

}
