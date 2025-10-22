#!/bin/bash

# Простой скрипт для создания темы TraumaUnites на сервере
# Выполните этот скрипт на сервере

echo "🏥 Создаем тему TraumaUnites..."

# Создаем директорию темы
mkdir -p /var/www/html/wp-content/themes/traumaunites
cd /var/www/html/wp-content/themes/traumaunites

# Создаем основные файлы темы
cat > style.css << 'EOF'
/*
Theme Name: TraumaUnites
Description: Custom WordPress theme for TraumaUnites medical website
Version: 1.0
Author: TraumaUnites Team
*/

/* This file is required by WordPress but actual styles are in the build.css file */
EOF

cat > functions.php << 'EOF'
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
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'traumaunites'),
        'footer' => __('Footer Menu', 'traumaunites'),
    ));
}
add_action('after_setup_theme', 'traumaunites_setup');

// Enqueue styles and scripts
function traumaunites_scripts() {
    $theme_url = get_template_directory_uri();
    
    wp_enqueue_style('traumaunites-style', $theme_url . '/assets/css/build.css', array(), '1.0.0');
    wp_enqueue_script('traumaunites-script', $theme_url . '/assets/js/build.js', array(), '1.0.0', true);
    wp_enqueue_style('traumaunites-fonts', 'https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap', array(), null);
}
add_action('wp_enqueue_scripts', 'traumaunites_scripts');

// Add custom post types
function traumaunites_custom_post_types() {
    register_post_type('services', array(
        'labels' => array(
            'name' => 'Services',
            'singular_name' => 'Service',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-admin-tools',
    ));
    
    register_post_type('doctors', array(
        'labels' => array(
            'name' => 'Doctors',
            'singular_name' => 'Doctor',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-admin-users',
    ));
    
    register_post_type('awards', array(
        'labels' => array(
            'name' => 'Awards',
            'singular_name' => 'Award',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-awards',
    ));
}
add_action('init', 'traumaunites_custom_post_types');
EOF

cat > index.php << 'EOF'
<?php
get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <h1>TraumaUnites Medical Center</h1>
        <p>Welcome to TraumaUnites - your trusted medical partner.</p>
        
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article>
                    <h2><?php the_title(); ?></h2>
                    <?php the_content(); ?>
                </article>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
EOF

cat > header.php << 'EOF'
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="header">
    <div class="container">
        <h1><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
        <nav>
            <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
        </nav>
    </div>
</header>
EOF

cat > footer.php << 'EOF'
<footer id="footer">
    <div class="container">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
EOF

# Создаем папку assets
mkdir -p assets/css assets/js assets/img

# Создаем базовые стили
cat > assets/css/build.css << 'EOF'
/* TraumaUnites Basic Styles */
body {
    font-family: 'Manrope', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

#header {
    background-color: #2c5aa0;
    color: white;
    padding: 20px 0;
}

#header h1 a {
    color: white;
    text-decoration: none;
}

#header nav ul {
    list-style: none;
    display: flex;
    gap: 20px;
}

#header nav a {
    color: white;
    text-decoration: none;
}

#main {
    padding: 40px 0;
    min-height: 400px;
}

#footer {
    background-color: #333;
    color: white;
    padding: 20px 0;
    text-align: center;
}
EOF

# Настраиваем права
chown -R www-data:www-data /var/www/html/wp-content/themes/traumaunites
chmod -R 755 /var/www/html/wp-content/themes/traumaunites

echo "✅ Тема TraumaUnites создана!"
echo "🎨 Теперь активируйте её в админке WordPress: Внешний вид → Темы"
