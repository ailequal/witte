<?php

namespace Ailequal\Plugins\Witte\Controllers\CustomPostType\Course;

use Ailequal\Plugins\Witte\Abstracts\Hook;
use Ailequal\Plugins\Witte\Traits\Singleton;

/**
 * The Column plugin class for the course.
 * Define the custom columns for the course.
 */
class Column extends Hook
{

    use Singleton;

    /**
     * Loads all the hooks related to this class.
     */
    public function hooks()
    {
        add_filter('manage_course_posts_columns', [$this, 'injectColumnHeaderThumbnail'], 10, 1);
        add_action('manage_course_posts_custom_column', [$this, 'injectColumnContentThumbnail'], 10, 2);
    }

    /**
     * Add the thumbnail column header in the backend.
     *
     * @param  array  $postColumns
     *
     * @return array
     */
    public function injectColumnHeaderThumbnail($postColumns)
    {
        if (true == array_key_exists('thumbnail', $postColumns))
            return $postColumns;

        // Set the thumbnail column right after the title one.
        // @link https://stackoverflow.com/questions/3353745/how-to-insert-element-into-arrays-at-specific-position
        return array_slice($postColumns, 0, 2, true) +
               ['thumbnail' => __('Thumbnails')] +
               array_slice($postColumns, 2, count($postColumns) - 1, true);
    }

    /**
     * Add the thumbnail column content in the backend.
     *
     * @param  string  $columnName
     * @param  int  $post_id
     */
    public function injectColumnContentThumbnail($columnName, $post_id)
    {
        if ('thumbnail' != $columnName)
            return;

        $thumbnail = get_the_post_thumbnail($post_id, 'thumbnail');
        if (true == empty($thumbnail))
            $thumbnail = '—';

        echo $thumbnail;
    }

}
