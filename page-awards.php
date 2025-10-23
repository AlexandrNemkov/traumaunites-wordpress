<?php
/*
Template Name: Awards Page
*/
get_header(); ?>

<section class="relative mt-24">
    <div class="container">
        <div class="flex items-center gap-4 flex-wrap text-black text-opacity-80">
            <a href="<?php echo home_url(); ?>" class="transition hover:text-blue-60">Main</a>
            <svg class="size-16"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#right"></use></svg>
            <span class="text-opacity-100 text-blue-60">Awards and licenses</span>
        </div>
    </div>
</section>

<section class="relative mt-40 lg:mt-64">
    <div class="container">
        <div class="grid grid-cols-1 gap-20 md:grid-cols-2 md:gap-y-40 lg:grid-cols-3">
            <?php
            $args = array(
                'post_type' => 'awards',
                'posts_per_page' => 12,
                'post_status' => 'publish'
            );
            $query = new WP_Query($args);
            
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    $award_image = get_post_meta(get_the_ID(), 'award_image', true);
                    $award_description = get_post_meta(get_the_ID(), 'award_description', true);
            ?>
            <div class="bg-grey-20 p-16 rounded-24">
                <div class="relative group/pic">
                    <?php if ($award_image) : ?>
                        <img src="<?php echo esc_url($award_image); ?>" alt="<?php the_title(); ?>" data-fancybox="award" class="w-full h-320 rounded-12 object-cover cursor-pointer">
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/award.webp" alt="<?php the_title(); ?>" data-fancybox="award" class="w-full h-320 rounded-12 object-cover cursor-pointer">
                    <?php endif; ?>
                    <svg class="size-24 transition absolute right-8 bottom-8 pointer-events-none opacity-50 group-hover/pic:opacity-100"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#expand"></use></svg>
                </div>
                <div class="mt-16 text-24 font-semibold transition"><?php the_title(); ?></div>
                <div class="mt-8 opacity-80"><?php echo $award_description ? esc_html($award_description) : wp_trim_words(get_the_content(), 15); ?></div>
            </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
            <div class="col-span-full text-center py-20">
                <p>No awards found.</p>
            </div>
            <?php endif; ?>
        </div>
        <button type="button" class="tw-btn tw-btn--arrow mt-40 w-full group">
            <span>View more</span>
            <svg class="tw-btn-icon p-4"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#arrow-up"></use></svg>
        </button>
    </div>
</section>

<?php get_footer(); ?>
