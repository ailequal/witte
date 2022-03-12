<?php

namespace Ailequal\Plugins\Witte\Controllers\CustomPostType\Course;

use Ailequal\Plugins\Witte\Abstracts\Hook;
use Ailequal\Plugins\Witte\Traits\Singleton;

/**
 * The Course plugin class.
 * Define the course custom post type.
 */
class Course extends Hook
{

    use Singleton;

    /**
     * The custom post type slug.
     *
     * @var string
     */
    protected $slug = 'course';

    /**
     * Loads all the hooks related to this class.
     */
    public function hooks()
    {
        add_action('init', [$this, 'register']);
    }

    /**
     * Register the custom post type.
     */
    public function register()
    {
        $labels = [
            'name'                  => _x('Courses', 'Post Type General Name', 'witte'),
            'singular_name'         => _x('Course', 'Post Type Singular Name', 'witte'),
            'menu_name'             => __('Courses', 'witte'),
            'name_admin_bar'        => __('Course', 'witte'),
            'archives'              => __('Course Archives', 'witte'),
            'attributes'            => __('Course Attributes', 'witte'),
            'parent_item_colon'     => __('Parent Course:', 'witte'),
            'all_items'             => __('All Courses', 'witte'),
            'add_new_item'          => __('Add New Course', 'witte'),
            'add_new'               => __('Add New', 'witte'),
            'new_item'              => __('New Course', 'witte'),
            'edit_item'             => __('Edit Course', 'witte'),
            'update_item'           => __('Update Course', 'witte'),
            'view_item'             => __('View Course', 'witte'),
            'view_items'            => __('View Courses', 'witte'),
            'search_items'          => __('Search Course', 'witte'),
            'not_found'             => __('Not found', 'witte'),
            'not_found_in_trash'    => __('Not found in Trash', 'witte'),
            'featured_image'        => __('Featured Image', 'witte'),
            'set_featured_image'    => __('Set featured image', 'witte'),
            'remove_featured_image' => __('Remove featured image', 'witte'),
            'use_featured_image'    => __('Use as featured image', 'witte'),
            'insert_into_item'      => __('Insert into course', 'witte'),
            'uploaded_to_this_item' => __('Uploaded to this course', 'witte'),
            'items_list'            => __('Courses list', 'witte'),
            'items_list_navigation' => __('Courses list navigation', 'witte'),
            'filter_items_list'     => __('Filter courses list', 'witte'),
        ];

        $args = [
            'label'               => __('Course', 'witte'),
            'description'         => __('Your delicious course.', 'witte'),
            'labels'              => $labels,
            'supports'            => ['title', 'thumbnail'],
            'taxonomies'          => ['course_cat', 'course_tag'], // TODO: Inject slugs from the relative class.
            'hierarchical'        => false,
            'public'              => false,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 5,
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => false,
            'can_export'          => true,
            'has_archive'         => false,
            'exclude_from_search' => true,
            'publicly_queryable'  => false,
            'capability_type'     => 'post',
        ];

        register_post_type($this->slug, $args);
    }

}
