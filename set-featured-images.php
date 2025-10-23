<?php
/**
 * Script to set featured images for articles
 */

// WordPress configuration
define('WP_USE_THEMES', false);
require_once('/var/www/html/wordpress/wp-config.php');

// Get all published posts
$posts = get_posts(array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'numberposts' => -1
));

// Get all images from media library
$images = get_posts(array(
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'numberposts' => -1
));

echo "Found " . count($posts) . " posts and " . count($images) . " images\n";

// Assign images to posts
foreach ($posts as $index => $post) {
    if (isset($images[$index])) {
        $image_id = $images[$index]->ID;
        $result = set_post_thumbnail($post->ID, $image_id);
        
        if ($result) {
            echo "Set featured image for post: " . $post->post_title . " (Image ID: " . $image_id . ")\n";
        } else {
            echo "Failed to set featured image for post: " . $post->post_title . "\n";
        }
    }
}

echo "Done!\n";
?>
