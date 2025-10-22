<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="header" class="pt-8 lg:pt-16 group transition <?php echo (is_home() || is_front_page()) ? 'absolute top-0 left-0 right-0 z-10' : ''; ?>">
    <div class="container">
        <div class="flex items-center transition <?php echo (is_home() || is_front_page()) ? 'pr-16 lg:pr-24 group-[.is-fixed]:bg-blue-20 group-[.is-fixed]:px-16 lg:group-[.is-fixed]:px-32 group-[.is-fixed]:rounded-32 lg:group-[.is-fixed]:-mx-32' : 'bg-blue-20 p-16 lg:px-32 rounded-32 lg:-mx-32'; ?> group-[.is-fixed]:py-8 group-[.is-fixed]:shadow-dropdown">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="relative text-black flex flex-none items-center gap-6 text-20 font-extrabold leading-none transition <?php echo (is_home() || is_front_page()) ? 'bg-white py-22 pr-16 rounded-br-24 group-[.is-fixed]:p-0 group-[.is-fixed]:bg-transparent' : ''; ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg" width="20" height="20" alt="<?php bloginfo('name'); ?>">
                <?php bloginfo('name'); ?>
                <?php if (is_home() || is_front_page()) : ?>
                <div class="bg-white absolute top-0 -right-24 group-[.is-fixed]:hidden"><div class="size-24 bg-blue-20 rounded-tl-24"></div></div>
                <div class="bg-white absolute -bottom-24 left-0 group-[.is-fixed]:hidden"><div class="size-24 bg-blue-20 rounded-tl-24"></div></div>
                <?php endif; ?>
            </a>
            
            <div class="relative ml-auto <?php echo (is_home() || is_front_page()) ? 'lg:ml-16 lg:group-[.is-fixed]:ml-32' : 'lg:ml-32'; ?>">
                <a href="#menu" data-js="dropdown_toggle" class="flex items-center gap-16 font-semibold p-4 pl-16 bg-grey-20 rounded-full uppercase">
                    Menu
                    <div class="bg-blue-60 rounded-full size-24 flex flex-col items-center justify-center gap-2 ml-auto" data-js="menu_burger">
                        <span class="bg-white h-2 w-14 rounded-full transition"></span>
                        <span class="bg-white h-2 w-14 rounded-full transition"></span>
                        <span class="bg-white h-2 w-14 rounded-full transition"></span>
                    </div>
                </a>
                <nav id="menu" class="tw-dropdown w-240 left-auto lg:right-auto lg:left-0" data-js="dropdown">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_class' => 'menu',
                        'container' => false,
                        'fallback_cb' => 'traumaunites_default_menu',
                    ));
                    ?>
                </nav>
            </div>
            
            <div class="hidden ml-auto relative lg:block">
                <?php if (is_user_logged_in()) : ?>
                <a href="<?php echo esc_url(get_author_posts_url(get_current_user_id())); ?>" class="flex items-center gap-16 font-semibold p-4 pl-16 bg-grey-20 rounded-full uppercase">
                    Profile
                    <svg class="bg-blue-60 text-white rounded-full size-24 p-4"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#profile"></use></svg>
                </a>
                <?php else : ?>
                <a href="#profile_menu" data-js="dropdown_toggle" class="flex items-center gap-16 font-semibold p-4 pl-16 bg-grey-20 rounded-full uppercase">
                    Profile
                    <svg class="bg-blue-60 text-white rounded-full size-24 p-4"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#profile"></use></svg>
                </a>
                <nav id="profile_menu" class="tw-dropdown" data-js="dropdown">
                    <a href="<?php echo wp_login_url(); ?>" class="px-16 py-12 bg-white transition hover:text-blue-40">Log in</a>
                    <a href="<?php echo wp_registration_url(); ?>" class="px-16 py-12 bg-white transition hover:text-blue-40">Register</a>
                </nav>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

<?php
// Default menu fallback
function traumaunites_default_menu() {
    echo '<a href="' . esc_url(home_url('/about')) . '" class="px-16 py-12 bg-white transition hover:text-blue-40">About</a>';
    echo '<a href="' . esc_url(home_url('/services')) . '" class="px-16 py-12 bg-white transition hover:text-blue-40">Services</a>';
    echo '<a href="' . esc_url(home_url('/book')) . '" class="px-16 py-12 bg-white transition hover:text-blue-40">Book an appointment</a>';
    echo '<a href="' . esc_url(home_url('/articles')) . '" class="px-16 py-12 bg-white transition hover:text-blue-40">Articles</a>';
}
?>
