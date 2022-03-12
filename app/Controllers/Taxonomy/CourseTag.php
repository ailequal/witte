<?php

namespace Ailequal\Plugins\Witte\Controllers\Taxonomy;

use Ailequal\Plugins\Witte\Abstracts\Hook;
use Ailequal\Plugins\Witte\Traits\Singleton;

/**
 * The Course Tag plugin class.
 * Define the tag taxonomy for the course custom post type.
 */
class CourseTag extends Hook
{

    use Singleton;

    /**
     * The taxonomy slug.
     *
     * @var string
     */
    protected $slug = 'course_tag';

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
            'name'                       => _x('Tags', 'Taxonomy General Name', 'witte'),
            'singular_name'              => _x('Tag', 'Taxonomy Singular Name', 'witte'),
            'menu_name'                  => __('Tag', 'witte'),
            'all_items'                  => __('All Tags', 'witte'),
            'parent_item'                => __('Parent Tag', 'witte'),
            'parent_item_colon'          => __('Parent Tag:', 'witte'),
            'new_item_name'              => __('New Tag Name', 'witte'),
            'add_new_item'               => __('Add New Tag', 'witte'),
            'edit_item'                  => __('Edit Tag', 'witte'),
            'update_item'                => __('Update Tag', 'witte'),
            'view_item'                  => __('View Tag', 'witte'),
            'separate_items_with_commas' => __('Separate tags with commas', 'witte'),
            'add_or_remove_items'        => __('Add or remove tags', 'witte'),
            'choose_from_most_used'      => __('Choose from the most used', 'witte'),
            'popular_items'              => __('Popular Tags', 'witte'),
            'search_items'               => __('Search Tags', 'witte'),
            'not_found'                  => __('Not Found', 'witte'),
            'no_terms'                   => __('No tags', 'witte'),
            'items_list'                 => __('Tags list', 'witte'),
            'items_list_navigation'      => __('Tags list navigation', 'witte'),
        ];

        $args = [
            'labels'            => $labels,
            'hierarchical'      => false,
            'public'            => false,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => false,
            'show_tagcloud'     => false,
        ];

        register_taxonomy($this->slug, ['course'], $args); // TODO: Inject slugs from the relative class.
    }

}
