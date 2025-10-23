<?php
/**
 * Template part for displaying the hero section
 */

$body_data = include get_template_directory() . '/template-parts/body-data.php';
?>

<section class="relative pt-8 lg:pt-16 overflow-hidden">
    <div class="container">
        <div class="bg-blue-20 rounded-24 p-8 pt-100 pb-420 relative md:pb-620 lg:p-32 lg:pt-100">
            <video id="hero-video" src="<?php echo get_template_directory_uri(); ?>/assets/video/body.mp4" class="absolute left-0 right-0 bottom-0 h-380 w-full object-cover rounded-24 pointer-events-none md:h-580 lg:w-body-video lg:h-full lg:left-auto" autoplay muted playsinline loop preload="auto"></video>
            <h1 class="text-40 font-semibold leading-none md:text-60 lg:text-80 lg:w-1/2 xl:text-100" data-animate="text">The future of your body health</h1>
            <div class="mt-16 opacity-80 md:max-w-460 lg:text-20 lg:mt-24 leading-tight" data-animate="fadein" data-animation-delay="3000">Share your problem with our interactive board and we will do our proffesional best to help you</div>
            <a href="#appointment-form" class="tw-btn tw-btn--arrow mt-16 w-full group lg:w-300 lg:mt-24" data-animate="fadein" data-animation-delay="3500">
                <span>Try it now</span>
                <svg class="tw-btn-icon p-4"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#arrow-up"></use></svg>
            </a>
            <div class="flex overflow-x-auto gap-8 mt-120 absolute bottom-8 left-8 -right-16 pr-24 lg:relative lg:bottom-0 lg:left-0 lg:right-0 lg:-mr-48 lg:pr-48 xl:gap-20 xl:overflow-visible xl:pr-0 xl:mr-0" data-animate="slideleft" data-animation-delay="4000">
                <?php
                $awards_query = new WP_Query(array(
                    'post_type' => 'awards',
                    'posts_per_page' => 3,
                    'post_status' => 'publish'
                ));
                
                if ($awards_query->have_posts()) :
                    while ($awards_query->have_posts()) : $awards_query->the_post();
                        $award_image = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                        if (!$award_image) {
                            $award_image = get_template_directory_uri() . '/assets/img/award.webp';
                        }
                ?>
                <div class="flex-none p-8 bg-white bg-opacity-60 rounded-24 group md:flex md:w-5/12 md:items-start md:gap-16 md:p-16 xl:flex-1 xl:w-auto">
                    <div class="relative flex-none group/pic">
                        <img src="<?php echo esc_url($award_image); ?>" alt="<?php the_title(); ?>" data-fancybox class="w-120 h-120 rounded-12 object-cover cursor-pointer">
                        <svg class="size-24 transition absolute right-8 bottom-8 pointer-events-none opacity-50 group-hover/pic:opacity-100"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#expand"></use></svg>
                    </div>
                    <div class="mt-8 px-8 md:px-0 md:mt-0">
                        <div class="font-semibold transition group-hover:text-blue-40 md:text-24"><?php the_title(); ?></div>
                        <div class="hidden mt-8 opacity-80 md:block"><?php echo wp_trim_words(get_the_excerpt(), 10); ?></div>
                    </div>
                </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                <div class="flex-none p-8 bg-white bg-opacity-60 rounded-24 group md:flex md:w-5/12 md:items-start md:gap-16 md:p-16 xl:flex-1 xl:w-auto">
                    <div class="relative flex-none group/pic">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/license.webp" alt="License" data-fancybox class="size-120 rounded-12 object-cover cursor-pointer">
                        <svg class="size-24 transition absolute right-8 bottom-8 pointer-events-none opacity-50 group-hover/pic:opacity-100"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#expand"></use></svg>
                    </div>
                    <div class="mt-8 px-8 md:px-0 md:mt-0">
                        <div class="font-semibold transition group-hover:text-blue-40 md:text-24">License</div>
                        <div class="hidden mt-8 opacity-80 md:block">Four string text about the License text text text text</div>
                    </div>
                </div>
                <div class="flex-none p-8 bg-white bg-opacity-60 rounded-24 group md:flex md:w-5/12 md:items-start md:gap-16 md:p-16 xl:flex-1 xl:w-auto">
                    <div class="relative flex-none group/pic">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/award.webp" alt="Award" data-fancybox class="size-120 rounded-12 object-cover cursor-pointer">
                        <svg class="size-24 transition absolute right-8 bottom-8 pointer-events-none opacity-50 group-hover/pic:opacity-100"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#expand"></use></svg>
                    </div>
                    <div class="mt-8 px-8 md:px-0 md:mt-0">
                        <div class="font-semibold transition group-hover:text-blue-40 md:text-24">Award</div>
                        <div class="hidden mt-8 opacity-80 md:block">Four string text about the award text text text text</div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="w-140 flex-none flex flex-col justify-between gap-16 p-8 bg-white bg-opacity-60 rounded-24 md:w-170 md:p-16">
                    <div class="font-semibold text-center uppercase">More awards and lisenses</div>
                    <a href="<?php echo esc_url(home_url('/awards')); ?>" class="tw-btn tw-btn--secondary">View all</a>
                </div>
            </div>
        </div>
    </div>
</section>
