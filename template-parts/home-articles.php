<?php
/**
 * Template part for displaying the articles section
 */

$articles_query = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'post_status' => 'publish'
));
?>

<section class="relative mt-80 md:mt-120 lg:mt-150">
    <div class="container">
        <h2 class="text-28 font-semibold lg:text-48" data-animate="text">Latest articles</h2>
        <div class="mt-20 flex gap-20 overflow-x-auto -mr-16 pr-16 lg:overflow-visible lg:mr-0 lg:pr-0 lg:mt-40" data-animate="slideleft">
            <?php if ($articles_query->have_posts()) : ?>
                <?php while ($articles_query->have_posts()) : $articles_query->the_post(); ?>
                    <a href="<?php the_permalink(); ?>" class="w-1/3 min-w-320 group/item lg:w-auto lg:flex-1">
                        <div class="relative rounded-24 overflow-hidden">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>" alt="<?php the_title(); ?>" class="w-full h-320 object-cover">
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/article.webp" alt="<?php the_title(); ?>" class="w-full h-320 object-cover">
                            <?php endif; ?>
                            <div class="absolute hidden inset-0 bg-black bg-opacity-30 lg:block lg:opacity-0 lg:transition group-hover/item:opacity-100"></div>
                            <div class="absolute top-20 left-20 flex items-center gap-12 text-blue-60 text-12 uppercase font-bold leading-none lg:transition lg:opacity-0 group-hover/item:opacity-100">
                                <?php
                                $categories = get_the_category();
                                if ($categories) {
                                    foreach (array_slice($categories, 0, 2) as $category) {
                                        echo '<span class="bg-white bg-opacity-60 rounded-full px-8 py-6">' . esc_html($category->name) . '</span>';
                                    }
                                } else {
                                    echo '<span class="bg-white bg-opacity-60 rounded-full px-8 py-6">Joint pain</span>';
                                    echo '<span class="bg-white bg-opacity-60 rounded-full px-8 py-6">Sports injuries</span>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="flex items-center justify-between gap-16 mt-16 text-14 opacity-50">
                            <span>Author: <?php the_author(); ?></span>
                            <span><?php echo get_the_date('F j, Y'); ?></span>
                        </div>
                        <div class="text-20 mt-8 font-semibold"><?php the_title(); ?></div>
                        <div class="opacity-80 mt-8"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></div>
                        <div class="mt-8 inline-flex items-center gap-4 text-blue-40 uppercase font-semibold">
                            Read more
                            <svg class="size-16"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#arrow-up"></use></svg>
                        </div>
                    </a>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <!-- Default articles if none are added -->
                <?php for ($i = 0; $i < 3; $i++) : ?>
                <a href="#" class="w-1/3 min-w-320 group/item lg:w-auto lg:flex-1">
                    <div class="relative rounded-24 overflow-hidden">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/article.webp" alt="" class="w-full h-320 object-cover">
                        <div class="absolute hidden inset-0 bg-black bg-opacity-30 lg:block lg:opacity-0 lg:transition group-hover/item:opacity-100"></div>
                        <div class="absolute top-20 left-20 flex items-center gap-12 text-blue-60 text-12 uppercase font-bold leading-none lg:transition lg:opacity-0 group-hover/item:opacity-100">
                            <span class="bg-white bg-opacity-60 rounded-full px-8 py-6">Joint pain</span>
                            <span class="bg-white bg-opacity-60 rounded-full px-8 py-6">Sports injuries</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between gap-16 mt-16 text-14 opacity-50">
                        <span>Author: Dr. Pau López Osornio</span>
                        <span>March 25, 2024</span>
                    </div>
                    <div class="text-20 mt-8 font-semibold">Exoneurolysis surgery on the arm: procedure and benefits</div>
                    <div class="opacity-80 mt-8">Exoneurolysis in the arm is a surgical procedure to relieve nerve compression. It is performed to eliminate tumors that affect the nerves of the arm.</div>
                    <div class="mt-8 inline-flex items-center gap-4 text-blue-40 uppercase font-semibold">
                        Read more
                        <svg class="size-16"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#arrow-up"></use></svg>
                    </div>
                </a>
                <?php endfor; ?>
            <?php endif; ?>
        </div>
        <a href="<?php echo esc_url(home_url('/articles')); ?>" class="tw-btn tw-btn--arrow mt-20 w-full group lg:mt-40" data-animate="slideup" data-animation-delay="500">
            <span>View all</span>
            <svg class="tw-btn-icon p-4"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#arrow-up"></use></svg>
        </a>
    </div>
</section>
