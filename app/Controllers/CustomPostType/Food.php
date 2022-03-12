<?php

namespace Ailequal\Plugins\Witte\Controllers\CustomPostType;

use Ailequal\Plugins\Witte\Abstracts\Hook;
use Ailequal\Plugins\Witte\Traits\Singleton;

/**
 * The Food plugin class.
 * Define the food custom post type.
 */
class Food extends Hook
{

    use Singleton;

    /**
     * Loads all the hooks related to this class.
     */
    public function hooks()
    {
        add_action('init', [$this, 'register']);
    }

    /**
     * register()
     */
    public function register()
    {
        $labels = [
            'name'                  => _x('Foods', 'Post Type General Name', 'witte'),
            'singular_name'         => _x('Food', 'Post Type Singular Name', 'witte'),
            'menu_name'             => __('Post Types', 'witte'),
            'name_admin_bar'        => __('Post Type', 'witte'),
            'archives'              => __('Item Archives', 'witte'),
            'attributes'            => __('Item Attributes', 'witte'),
            'parent_item_colon'     => __('Parent Item:', 'witte'),
            'all_items'             => __('All Items', 'witte'),
            'add_new_item'          => __('Add New Item', 'witte'),
            'add_new'               => __('Add New', 'witte'),
            'new_item'              => __('New Item', 'witte'),
            'edit_item'             => __('Edit Item', 'witte'),
            'update_item'           => __('Update Item', 'witte'),
            'view_item'             => __('View Item', 'witte'),
            'view_items'            => __('View Items', 'witte'),
            'search_items'          => __('Search Item', 'witte'),
            'not_found'             => __('Not found', 'witte'),
            'not_found_in_trash'    => __('Not found in Trash', 'witte'),
            'featured_image'        => __('Featured Image', 'witte'),
            'set_featured_image'    => __('Set featured image', 'witte'),
            'remove_featured_image' => __('Remove featured image', 'witte'),
            'use_featured_image'    => __('Use as featured image', 'witte'),
            'insert_into_item'      => __('Insert into item', 'witte'),
            'uploaded_to_this_item' => __('Uploaded to this item', 'witte'),
            'items_list'            => __('Items list', 'witte'),
            'items_list_navigation' => __('Items list navigation', 'witte'),
            'filter_items_list'     => __('Filter items list', 'witte'),
        ];

        $args = [
            'label'               => __('Food', 'witte'),
            'description'         => __('Your delicious food.', 'witte'),
            'labels'              => $labels,
            'supports'            => ['title', 'editor'],
            'taxonomies'          => ['category', 'post_tag'],
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 5,
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        ];

        register_post_type('witte_food', $args);
    }

}
