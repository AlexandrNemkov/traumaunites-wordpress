<?php
/**
 * TraumaUnites Theme Functions
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Theme setup
function traumaunites_setup() {
    // Add theme support for various features
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'traumaunites'),
        'footer' => __('Footer Menu', 'traumaunites'),
    ));
}
add_action('after_setup_theme', 'traumaunites_setup');

// Enqueue styles and scripts
function traumaunites_scripts() {
    // Get theme directory URL
    $theme_url = get_template_directory_uri();
    
    // Enqueue main stylesheet
    wp_enqueue_style('traumaunites-style', $theme_url . '/assets/css/build.css', array(), '1.0.0');
    
    // Enqueue main JavaScript
    wp_enqueue_script('traumaunites-script', $theme_url . '/assets/js/build.js', array(), '1.0.0', true);
    
    // Enqueue survey JavaScript
    wp_enqueue_script('traumaunites-survey', $theme_url . '/assets/js/survey.js', array(), '1.0.0', true);
    
    // Enqueue AirDatepicker
    wp_enqueue_style('air-datepicker-css', 'https://cdn.jsdelivr.net/npm/air-datepicker@3.5.2/air-datepicker.css', array(), '3.5.2');
    wp_enqueue_script('air-datepicker-js', 'https://cdn.jsdelivr.net/npm/air-datepicker@3.5.2/air-datepicker.js', array(), '3.5.2', true);
    
    // Enqueue Google Fonts
    wp_enqueue_style('traumaunites-fonts', 'https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap', array(), null);
}
add_action('wp_enqueue_scripts', 'traumaunites_scripts');

// Add custom post types
function traumaunites_custom_post_types() {
    // Services post type
    register_post_type('services', array(
        'labels' => array(
            'name' => 'Services',
            'singular_name' => 'Service',
            'add_new' => 'Add New Service',
            'add_new_item' => 'Add New Service',
            'edit_item' => 'Edit Service',
            'new_item' => 'New Service',
            'view_item' => 'View Service',
            'search_items' => 'Search Services',
            'not_found' => 'No services found',
            'not_found_in_trash' => 'No services found in trash',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-admin-tools',
    ));
    
    // Doctors post type
    register_post_type('doctors', array(
        'labels' => array(
            'name' => 'Doctors',
            'singular_name' => 'Doctor',
            'add_new' => 'Add New Doctor',
            'add_new_item' => 'Add New Doctor',
            'edit_item' => 'Edit Doctor',
            'new_item' => 'New Doctor',
            'view_item' => 'View Doctor',
            'search_items' => 'Search Doctors',
            'not_found' => 'No doctors found',
            'not_found_in_trash' => 'No doctors found in trash',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-admin-users',
    ));
    
    // Awards post type
    register_post_type('awards', array(
        'labels' => array(
            'name' => 'Awards',
            'singular_name' => 'Award',
            'add_new' => 'Add New Award',
            'add_new_item' => 'Add New Award',
            'edit_item' => 'Edit Award',
            'new_item' => 'New Award',
            'view_item' => 'View Award',
            'search_items' => 'Search Awards',
            'not_found' => 'No awards found',
            'not_found_in_trash' => 'No awards found in trash',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-awards',
    ));
}
add_action('init', 'traumaunites_custom_post_types');

// Add custom fields for appointments
function traumaunites_add_meta_boxes() {
    add_meta_box(
        'appointment_details',
        'Appointment Details',
        'traumaunites_appointment_meta_box_callback',
        'appointments',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'traumaunites_add_meta_boxes');

// Custom meta box callback
function traumaunites_appointment_meta_box_callback($post) {
    wp_nonce_field('traumaunites_appointment_meta_box', 'traumaunites_appointment_meta_box_nonce');
    
    $patient_name = get_post_meta($post->ID, '_patient_name', true);
    $patient_email = get_post_meta($post->ID, '_patient_email', true);
    $patient_phone = get_post_meta($post->ID, '_patient_phone', true);
    $appointment_date = get_post_meta($post->ID, '_appointment_date', true);
    $appointment_time = get_post_meta($post->ID, '_appointment_time', true);
    $pain_locations = get_post_meta($post->ID, '_pain_locations', true);
    $pain_types = get_post_meta($post->ID, '_pain_types', true);
    $pain_duration = get_post_meta($post->ID, '_pain_duration', true);
    $pain_intensity = get_post_meta($post->ID, '_pain_intensity', true);
    
    echo '<table class="form-table">';
    echo '<tr><th><label for="patient_name">Patient Name</label></th>';
    echo '<td><input type="text" id="patient_name" name="patient_name" value="' . esc_attr($patient_name) . '" size="50" /></td></tr>';
    
    echo '<tr><th><label for="patient_email">Patient Email</label></th>';
    echo '<td><input type="email" id="patient_email" name="patient_email" value="' . esc_attr($patient_email) . '" size="50" /></td></tr>';
    
    echo '<tr><th><label for="patient_phone">Patient Phone</label></th>';
    echo '<td><input type="tel" id="patient_phone" name="patient_phone" value="' . esc_attr($patient_phone) . '" size="50" /></td></tr>';
    
    echo '<tr><th><label for="appointment_date">Appointment Date</label></th>';
    echo '<td><input type="date" id="appointment_date" name="appointment_date" value="' . esc_attr($appointment_date) . '" /></td></tr>';
    
    echo '<tr><th><label for="appointment_time">Appointment Time</label></th>';
    echo '<td><input type="time" id="appointment_time" name="appointment_time" value="' . esc_attr($appointment_time) . '" /></td></tr>';
    
    echo '<tr><th><label for="pain_locations">Pain Locations</label></th>';
    echo '<td><textarea id="pain_locations" name="pain_locations" rows="3" cols="50">' . esc_textarea($pain_locations) . '</textarea></td></tr>';
    
    echo '<tr><th><label for="pain_types">Pain Types</label></th>';
    echo '<td><textarea id="pain_types" name="pain_types" rows="3" cols="50">' . esc_textarea($pain_types) . '</textarea></td></tr>';
    
    echo '<tr><th><label for="pain_duration">Pain Duration</label></th>';
    echo '<td><input type="text" id="pain_duration" name="pain_duration" value="' . esc_attr($pain_duration) . '" size="50" /></td></tr>';
    
    echo '<tr><th><label for="pain_intensity">Pain Intensity (1-10)</label></th>';
    echo '<td><input type="number" id="pain_intensity" name="pain_intensity" value="' . esc_attr($pain_intensity) . '" min="1" max="10" /></td></tr>';
    
    echo '</table>';
}

// Save custom meta box data
function traumaunites_save_appointment_meta_box($post_id) {
    if (!isset($_POST['traumaunites_appointment_meta_box_nonce'])) {
        return;
    }
    
    if (!wp_verify_nonce($_POST['traumaunites_appointment_meta_box_nonce'], 'traumaunites_appointment_meta_box')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    $fields = array('patient_name', 'patient_email', 'patient_phone', 'appointment_date', 'appointment_time', 'pain_locations', 'pain_types', 'pain_duration', 'pain_intensity');
    
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post', 'traumaunites_save_appointment_meta_box');

// Add appointments post type
function traumaunites_appointments_post_type() {
    register_post_type('appointments', array(
        'labels' => array(
            'name' => 'Appointments',
            'singular_name' => 'Appointment',
            'add_new' => 'Add New Appointment',
            'add_new_item' => 'Add New Appointment',
            'edit_item' => 'Edit Appointment',
            'new_item' => 'New Appointment',
            'view_item' => 'View Appointment',
            'search_items' => 'Search Appointments',
            'not_found' => 'No appointments found',
            'not_found_in_trash' => 'No appointments found in trash',
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'supports' => array('title', 'editor'),
        'menu_icon' => 'dashicons-calendar-alt',
        'capability_type' => 'post',
    ));
}
add_action('init', 'traumaunites_appointments_post_type');

// Add custom fields for services
function traumaunites_add_service_meta_boxes() {
    add_meta_box(
        'service_details',
        'Service Details',
        'traumaunites_service_meta_box_callback',
        'services',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'traumaunites_add_service_meta_boxes');

function traumaunites_service_meta_box_callback($post) {
    wp_nonce_field('traumaunites_service_meta_box', 'traumaunites_service_meta_box_nonce');
    
    $service_icon = get_post_meta($post->ID, '_service_icon', true);
    $service_description = get_post_meta($post->ID, '_service_description', true);
    
    echo '<table class="form-table">';
    echo '<tr><th><label for="service_icon">Service Icon URL</label></th>';
    echo '<td><input type="url" id="service_icon" name="service_icon" value="' . esc_attr($service_icon) . '" size="50" /></td></tr>';
    
    echo '<tr><th><label for="service_description">Service Description</label></th>';
    echo '<td><textarea id="service_description" name="service_description" rows="5" cols="50">' . esc_textarea($service_description) . '</textarea></td></tr>';
    echo '</table>';
}

function traumaunites_save_service_meta_box($post_id) {
    if (!isset($_POST['traumaunites_service_meta_box_nonce'])) {
        return;
    }
    
    if (!wp_verify_nonce($_POST['traumaunites_service_meta_box_nonce'], 'traumaunites_service_meta_box')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    $fields = array('service_icon', 'service_description');
    
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post', 'traumaunites_save_service_meta_box');

// Handle appointment form submission
function traumaunites_handle_appointment_submission() {
    if (!isset($_POST['appointment_nonce']) || !wp_verify_nonce($_POST['appointment_nonce'], 'appointment_form')) {
        wp_die('Security check failed');
    }
    
    // Sanitize and validate form data
    $patient_name = sanitize_text_field($_POST['name'] ?? '');
    $patient_surname = sanitize_text_field($_POST['surname'] ?? '');
    $patient_email = sanitize_email($_POST['email'] ?? '');
    $patient_phone = sanitize_text_field($_POST['phone'] ?? '');
    $appointment_date = sanitize_text_field($_POST['date'] ?? '');
    $appointment_time = sanitize_text_field($_POST['time'] ?? '');
    $description = sanitize_textarea_field($_POST['description'] ?? '');
    $birthdate = sanitize_text_field($_POST['birthdate'] ?? '');
    $insurance_company = sanitize_text_field($_POST['insurance_company'] ?? '');
    $vip = isset($_POST['vip']) ? 1 : 0;
    
    // Survey data
    $pain_locations = sanitize_text_field($_POST['pain_locations'] ?? '');
    $pain_types = sanitize_text_field($_POST['pain_types'] ?? '');
    $pain_duration = sanitize_text_field($_POST['how_long'] ?? '');
    $pain_intensity = sanitize_text_field($_POST['strength'] ?? '');
    
    // Create appointment post
    $appointment_data = array(
        'post_title' => $patient_name . ' ' . $patient_surname . ' - ' . $appointment_date . ' ' . $appointment_time,
        'post_content' => $description,
        'post_status' => 'publish',
        'post_type' => 'appointments',
    );
    
    $appointment_id = wp_insert_post($appointment_data);
    
    if ($appointment_id) {
        // Save meta data
        update_post_meta($appointment_id, '_patient_name', $patient_name . ' ' . $patient_surname);
        update_post_meta($appointment_id, '_patient_email', $patient_email);
        update_post_meta($appointment_id, '_patient_phone', $patient_phone);
        update_post_meta($appointment_id, '_appointment_date', $appointment_date);
        update_post_meta($appointment_id, '_appointment_time', $appointment_time);
        update_post_meta($appointment_id, '_pain_locations', $pain_locations);
        update_post_meta($appointment_id, '_pain_types', $pain_types);
        update_post_meta($appointment_id, '_pain_duration', $pain_duration);
        update_post_meta($appointment_id, '_pain_intensity', $pain_intensity);
        update_post_meta($appointment_id, '_birthdate', $birthdate);
        update_post_meta($appointment_id, '_insurance_company', $insurance_company);
        update_post_meta($appointment_id, '_vip', $vip);
        
        // Send email notification (optional)
        $admin_email = get_option('admin_email');
        $subject = 'New Appointment Request - ' . $patient_name . ' ' . $patient_surname;
        $message = "New appointment request:\n\n";
        $message .= "Patient: " . $patient_name . " " . $patient_surname . "\n";
        $message .= "Email: " . $patient_email . "\n";
        $message .= "Phone: " . $patient_phone . "\n";
        $message .= "Date: " . $appointment_date . "\n";
        $message .= "Time: " . $appointment_time . "\n";
        $message .= "Description: " . $description . "\n";
        
        wp_mail($admin_email, $subject, $message);
        
        // Redirect with success message
        wp_redirect(home_url('/?appointment=success'));
        exit;
    } else {
        wp_redirect(home_url('/?appointment=error'));
        exit;
    }
}
add_action('admin_post_submit_appointment', 'traumaunites_handle_appointment_submission');
add_action('admin_post_nopriv_submit_appointment', 'traumaunites_handle_appointment_submission');
