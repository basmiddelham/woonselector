<?php
/**
 * Snippets
 *
 * Filters, actions and functions for this theme.
 *
 * @package strt
 */

/**
 * Proper ob_end_flush() for all levels
 *
 * This replaces the WordPress `wp_ob_end_flush_all()` function
 * with a replacement that doesn't cause PHP notices.
 */
// remove_action('shutdown', 'wp_ob_end_flush_all', 1);
// add_action('shutdown', function () {
//     while (@ob_end_flush());
// });

/**
 * Simple function to pretty up our field partial includes.
 *
 * @param  mixed $partial
 * @return mixed
 */
function get_field_partial($partial) {
    $partial = str_replace('.', '/', $partial);
    return include(get_template_directory() . "/fields/{$partial}.php");
}

/**
 * Enqueue flexeditor-style in the WordPress admin edit pages.
 *
 * @param int $hook Hook suffix for the current admin page.
 */
// add_action('admin_enqueue_scripts', function ($hook) {
//     if ('post.php' === $hook) {
//         wp_enqueue_style('flexstyle', get_template_directory_uri() . '/dist/css/flexeditor-style.css');
//     } else {
//         return;
//     }
// });

/**
 * Registers an editor stylesheet for the theme.
 */
// add_action('admin_init', function () {
//     add_editor_style('dist/css/tinymce.css');
// });

/**
 * Add Google font to Admin
 */
// add_action('admin_enqueue_scripts', function () {
//     wp_enqueue_style('my-google-font', '//fonts.googleapis.com/css?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap');
// });

/**
 * Add Google font to TinyMCE
 */
// add_action('init', function () {
//     $font_url = '//fonts.googleapis.com/css?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap';
//     add_editor_style(str_replace(',', '%2C', $font_url));
// });

/**
 * Set thumbnail size
 */
set_post_thumbnail_size(200, 200, true);

/**
 * Add dropdown-icon to primary_navigation if menu item has children.
 */
add_filter('nav_menu_item_title', function ($title, $item, $args, $depth) {
    if ('primary_navigation' === $args->theme_location) {
        foreach ($item->classes as $value) {
            if ('menu-item-has-children' === $value || 'page_item_has_children' === $value) {
                $title = $title . '<svg xmlns="http://www.w3.org/2000/svg" width="8" height="5" aria-hidden="true" role="img" class="angleDown"><path fill="currentColor" d="M1 0l3 3 3-3 1 1-4 4-4-4z"/></svg>';
            }
        }
    }
    return $title;
}, 10, 4);

/**
 * Remove inline width from caption shortcode.
 */
add_filter('img_caption_shortcode_width', '__return_false');

/**
 * Disable Gutenberg editor.
 */
add_filter('use_block_editor_for_post', '__return_false');

/**
 * Remove the block styles file from wp_head().
 */
add_action('wp_enqueue_scripts', function () {
    wp_dequeue_style('wp-block-library'); // Gutenberg blocks CSS
});

/**
 * Add "… Continued" to the excerpt.
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'strt') . '</a>';
});

/**
 * Custom excerpt length.
 */
add_filter('excerpt_length', function ($length) {
    return 30;
});
