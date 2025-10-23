<?php
/**
 * The template for displaying all single posts
 * Updated: 2024-10-23 - Custom design implementation
 */

get_header(); ?>

<section class="relative mt-24">
    <div class="container">
        <div class="flex items-center gap-4 flex-wrap text-black text-opacity-80">
            <a href="<?php echo home_url(); ?>" class="transition hover:text-blue-60">Main</a>
            <svg class="size-16"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#right"></use></svg>
            <a href="<?php echo home_url('/articles'); ?>" class="transition hover:text-blue-60">Articles</a>
            <svg class="size-16"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#right"></use></svg>
            <span class="text-opacity-100 text-blue-60"><?php the_title(); ?></span>
        </div>
    </div>
</section>

<section class="relative mt-40 lg:mt-64">
    <div class="container">
        <div class="flex flex-col gap-80 lg:flex-row lg:gap-100">
            <article class="lg:flex-1">
                <?php
                while ( have_posts() ) :
                    the_post();
                ?>
                <h1 class="text-28 font-semibold leading-none lg:text-48"><?php the_title(); ?></h1>
                <div class="tw-html tw-html--article mt-40">
                    <?php
                    the_content();
                    wp_link_pages(
                        array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'traumaunites' ),
                            'after'  => '</div>',
                        )
                    );
                    ?>
                </div>
                <div class="flex flex-col gap-8 mt-40 leading-none text-black text-opacity-80 lg:flex-row lg:justify-between lg:gap-16">
                    <div class="flex items-center gap-8">
                        <div>Themes:</div>
                        <?php
                        $categories = get_the_category();
                        foreach ($categories as $category) {
                            echo '<div class="text-12 text-blue-60 font-bold uppercase">' . esc_html($category->name) . '</div>';
                        }
                        ?>
                    </div>
                    <div class="flex items-center gap-8">
                        <div>Author:</div>
                        <div class="text-12 text-blue-60 font-bold uppercase"><?php the_author(); ?></div>
                    </div>
                    <div class="flex items-center gap-8">
                        <div>Date:</div>
                        <div class="text-black text-opacity-50"><?php echo get_the_date('M j, Y'); ?></div>
                    </div>
                </div>
                <a href="<?php echo home_url('/articles'); ?>" class="tw-btn tw-btn--secondary mt-40">Back to all articles</a>
                <?php
                endwhile;
                ?>
            </article>
            <aside class="lg:w-1/3 lg:flex-none">
                <h2 class="text-28 font-semibold lg:text-32 leading-none">More on the topic</h2>
                <div class="mt-20 flex gap-20 overflow-x-auto -mr-16 pr-16 lg:overflow-visible lg:flex-col lg:gap-24 lg:mr-0 lg:pr-0 lg:mt-24">
                    <?php
                    $related_posts = new WP_Query(array(
                        'post_type' => 'post',
                        'posts_per_page' => 3,
                        'post_status' => 'publish',
                        'post__not_in' => array(get_the_ID()),
                        'orderby' => 'rand'
                    ));
                    
                    if ($related_posts->have_posts()) :
                        while ($related_posts->have_posts()) : $related_posts->the_post();
                    ?>
                    <a href="<?php the_permalink(); ?>" class="w-1/3 min-w-320 group/item lg:w-full">
                        <div class="relative rounded-24 overflow-hidden">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium', array('class' => 'w-full h-320 object-cover')); ?>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/article.webp" alt="" class="w-full h-320 object-cover">
                            <?php endif; ?>
                            <div class="absolute hidden inset-0 bg-black bg-opacity-30 lg:block lg:opacity-0 lg:transition group-hover/item:opacity-100"></div>
                            <div class="absolute top-20 left-20 flex items-center gap-12 text-blue-60 text-12 uppercase font-bold leading-none lg:transition lg:opacity-0 group-hover/item:opacity-100">
                                <?php
                                $categories = get_the_category();
                                foreach ($categories as $category) {
                                    echo '<span class="bg-white bg-opacity-60 rounded-full px-8 py-6">' . esc_html($category->name) . '</span>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="flex items-center justify-between gap-16 mt-16 text-14 opacity-50">
                            <span>Author: <?php the_author(); ?></span>
                            <span><?php echo get_the_date('M j, Y'); ?></span>
                        </div>
                        <div class="text-20 mt-8 font-semibold"><?php the_title(); ?></div>
                        <div class="opacity-80 mt-8"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></div>
                        <div class="mt-8 inline-flex items-center gap-4 text-blue-40 uppercase font-semibold">
                            Read more
                            <svg class="size-16"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#arrow-up"></use></svg>
                        </div>
                    </a>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
                <a href="<?php echo home_url('/articles'); ?>" class="tw-btn tw-btn--arrow mt-20 w-full group lg:mt-24">
                    <span>View all</span>
                    <svg class="tw-btn-icon p-4"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#arrow-up"></use></svg>
                </a>
            </aside>
        </div>
    </div>
</section>

<?php get_footer(); ?>
