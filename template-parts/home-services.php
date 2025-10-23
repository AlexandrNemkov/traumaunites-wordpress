<?php
/**
 * Template part for displaying the services section
 */

$services_query = new WP_Query(array(
    'post_type' => 'services',
    'posts_per_page' => 3,
    'post_status' => 'publish'
));
?>

<section id="services" class="relative mt-80 md:mt-120 lg:mt-150 overflow-hidden">
    <div class="container">
        <h2 class="text-28 font-semibold lg:text-48" data-animate="text">Our medical services</h2>
        <div class="mt-20 grid grid-cols-1 gap-20 md:grid-cols-3 lg:mt-40" data-animate="slideleft">
            <?php if ($services_query->have_posts()) : ?>
                <?php while ($services_query->have_posts()) : $services_query->the_post(); ?>
                    <div class="flex items-center gap-8 md:flex-col md:text-center md:justify-center">
                        <?php 
                        $service_icon = get_post_meta(get_the_ID(), '_service_icon', true);
                        if ($service_icon) : ?>
                            <img src="<?php echo esc_url($service_icon); ?>" alt="<?php the_title(); ?>" class="size-100 rounded-full lg:size-240 object-cover">
                        <?php elseif (has_post_thumbnail()) : ?>
                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="<?php the_title(); ?>" class="size-100 rounded-full lg:size-240 object-cover">
                        <?php else : ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/service-1.webp" alt="<?php the_title(); ?>" class="size-100 rounded-full lg:size-240 object-cover">
                        <?php endif; ?>
                        <div class="flex-1">
                            <div class="text-20 font-semibold lg:text-24"><?php the_title(); ?></div>
                            <div class="mt-8 opacity-50 lg:text-20">
                                <?php 
                                $service_description = get_post_meta(get_the_ID(), '_service_description', true);
                                if ($service_description) {
                                    echo esc_html($service_description);
                                } else {
                                    echo wp_trim_words(get_the_excerpt(), 15);
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <!-- Default services if none are added -->
                <div class="flex items-center gap-8 md:flex-col md:text-center md:justify-center">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/service-1.webp" alt="" class="size-100 rounded-full lg:size-240 object-cover">
                    <div class="flex-1">
                        <div class="text-20 font-semibold lg:text-24">Orthopedic and trauma surgery</div>
                        <div class="mt-8 opacity-50 lg:text-20">Surgeons, nurses and administrators complete a human and professional team of total trust.</div>
                    </div>
                </div>
                <div class="flex items-center gap-8 md:flex-col md:text-center md:justify-center">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/service-2.webp" alt="" class="size-100 rounded-full lg:size-240 object-cover">
                    <div class="flex-1">
                        <div class="text-20 font-semibold lg:text-24">Continuous innovation</div>
                        <div class="mt-8 opacity-50 lg:text-20">We work with the latest surgical techniques to resolve injuries to the brachial plexus and peripheral nerve.</div>
                    </div>
                </div>
                <div class="flex items-center gap-8 md:flex-col md:text-center md:justify-center">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/service-3.webp" alt="" class="size-100 rounded-full lg:size-240 object-cover">
                    <div class="flex-1">
                        <div class="text-20 font-semibold lg:text-24">Minimally invasive surgery</div>
                        <div class="mt-8 opacity-50 lg:text-20">We opt for a surgery with lower risk for the patient and with a shorter recovery time.</div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
