<?php
/**
 * Script to update awards with real data
 */

// WordPress configuration
define('WP_USE_THEMES', false);
require_once('/var/www/html/wordpress/wp-config.php');

// Real awards data
$awards_data = array(
    array(
        'title' => 'Spanish Society of Hand Surgery - President',
        'description' => 'Dr. Joaquim Casañas serves as President of the Spanish Society of Hand Surgery, leading the organization in advancing hand surgery practices and research.',
        'image' => '/wp-content/themes/traumaunites/assets/img/award.webp'
    ),
    array(
        'title' => 'European Federation for Surgery of the Hand - Committee Member',
        'description' => 'Active member of several committees within the European Federation for Surgery of the Hand, contributing to European standards and guidelines.',
        'image' => '/wp-content/themes/traumaunites/assets/img/award.webp'
    ),
    array(
        'title' => 'American Society for Surgery of the Hand - Fellow',
        'description' => 'Distinguished Fellow of the American Society for Surgery of the Hand, recognized for excellence in hand surgery practice and research.',
        'image' => '/wp-content/themes/traumaunites/assets/img/award.webp'
    ),
    array(
        'title' => 'Peripheral Nerve Surgery Certification',
        'description' => 'Specialized certification in peripheral nerve surgery, demonstrating expertise in complex nerve reconstruction procedures.',
        'image' => '/wp-content/themes/traumaunites/assets/img/license.webp'
    ),
    array(
        'title' => 'Microsurgery Fellowship',
        'description' => 'Completed advanced fellowship in microsurgery techniques, enabling precise surgical procedures for complex hand and nerve injuries.',
        'image' => '/wp-content/themes/traumaunites/assets/img/license.webp'
    ),
    array(
        'title' => 'Hand Surgery Board Certification',
        'description' => 'Board certified in hand surgery with over 25 years of experience in treating complex hand and wrist conditions.',
        'image' => '/wp-content/themes/traumaunites/assets/img/license.webp'
    )
);

// Get existing awards
$existing_awards = get_posts(array(
    'post_type' => 'awards',
    'post_status' => 'publish',
    'numberposts' => -1
));

echo "Found " . count($existing_awards) . " existing awards\n";

// Update existing awards with real data
foreach ($existing_awards as $index => $award) {
    if (isset($awards_data[$index])) {
        $data = $awards_data[$index];
        
        // Update post title and content
        wp_update_post(array(
            'ID' => $award->ID,
            'post_title' => $data['title'],
            'post_content' => $data['description']
        ));
        
        // Update meta fields
        update_post_meta($award->ID, 'award_description', $data['description']);
        update_post_meta($award->ID, 'award_image', $data['image']);
        
        echo "Updated award: " . $data['title'] . "\n";
    }
}

// Create additional awards if needed
$total_needed = 6;
$existing_count = count($existing_awards);

if ($existing_count < $total_needed) {
    for ($i = $existing_count; $i < $total_needed; $i++) {
        if (isset($awards_data[$i])) {
            $data = $awards_data[$i];
            
            $post_id = wp_insert_post(array(
                'post_title' => $data['title'],
                'post_content' => $data['description'],
                'post_type' => 'awards',
                'post_status' => 'publish'
            ));
            
            if ($post_id) {
                update_post_meta($post_id, 'award_description', $data['description']);
                update_post_meta($post_id, 'award_image', $data['image']);
                
                echo "Created new award: " . $data['title'] . "\n";
            }
        }
    }
}

echo "Done! Awards updated successfully.\n";
?>
