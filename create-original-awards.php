<?php
/**
 * Script to create awards from original frontend data
 */

// WordPress configuration
define('WP_USE_THEMES', false);
require_once('/var/www/html/wordpress/wp-config.php');

// Original awards data from frontend
$awards_data = array(
    array(
        'title' => 'License',
        'description' => 'Four string text about the License text text text text',
        'image' => '/wp-content/themes/traumaunites/assets/img/license.webp'
    ),
    array(
        'title' => 'Award',
        'description' => 'Four string text about the award text text text text',
        'image' => '/wp-content/themes/traumaunites/assets/img/award.webp'
    ),
    array(
        'title' => 'Award',
        'description' => 'Four string text about the award text text text text',
        'image' => '/wp-content/themes/traumaunites/assets/img/award.webp'
    )
);

echo "Creating awards from original frontend data...\n";

// Create awards
foreach ($awards_data as $data) {
    $post_id = wp_insert_post(array(
        'post_title' => $data['title'],
        'post_content' => $data['description'],
        'post_type' => 'awards',
        'post_status' => 'publish'
    ));
    
    if ($post_id) {
        update_post_meta($post_id, 'award_description', $data['description']);
        update_post_meta($post_id, 'award_image', $data['image']);
        
        echo "Created award: " . $data['title'] . "\n";
    }
}

echo "Done! Awards created successfully.\n";
?>
