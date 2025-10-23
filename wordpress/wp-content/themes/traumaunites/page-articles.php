<?php
/*
Template Name: Articles Page
*/
get_header(); ?>

<section class="relative mt-24">
    <div class="container">
        <div class="flex items-center gap-4 flex-wrap text-black text-opacity-80">
            <a href="<?php echo home_url(); ?>" class="transition hover:text-blue-60">Main</a>
            <svg class="size-16"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#right"></use></svg>
            <span class="text-opacity-100 text-blue-60">Articles</span>
        </div>
    </div>
</section>

<section class="relative mt-40 lg:mt-64">
    <div class="container">
        <div class="flex flex-col gap-20 md:flex-row">
            <div class="flex-1 max-w-320">
                <div class="uppercase font-semibold text-16">Author</div>
                <div class="relative mt-4">
                    <select name="author" class="tw-input peer" data-js="select">
                        <option value="">All</option>
                        <?php
                        $authors = get_users(array('role' => 'author'));
                        foreach ($authors as $author) {
                            echo '<option value="' . $author->ID . '">' . $author->display_name . '</option>';
                        }
                        ?>
                    </select>
                    <svg class="tw-input-icon pointer-events-none peer-focus:rotate-180"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#down"></use></svg>
                </div>
            </div>
            <div class="flex-1 max-w-320">
                <div class="uppercase font-semibold text-16">Theme</div>
                <div class="relative mt-4">
                    <select name="theme" class="tw-input peer" data-js="select">
                        <option value="">All</option>
                        <?php
                        $categories = get_categories();
                        foreach ($categories as $category) {
                            echo '<option value="' . $category->term_id . '">' . $category->name . '</option>';
                        }
                        ?>
                    </select>
                    <svg class="tw-input-icon pointer-events-none peer-focus:rotate-180"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#down"></use></svg>
                </div>
            </div>
            <div class="flex-1 max-w-320 md:ml-auto">
                <div class="uppercase font-semibold text-16">Sort</div>
                <div class="relative mt-4">
                    <select name="sort" class="tw-input peer" data-js="select">
                        <option value="">Newest</option>
                        <option value="oldest">Oldest</option>
                        <option value="popular">Most Popular</option>
                    </select>
                    <svg class="tw-input-icon pointer-events-none peer-focus:rotate-180"><use href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#down"></use></svg>
                </div>
            </div>
        </div>
        <div class="mt-40 grid grid-cols-1 gap-40 md:grid-cols-2 md:gap-20 lg:grid-cols-3">
            <?php
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 12,
                'post_status' => 'publish'
            );
            $query = new WP_Query($args);
            
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
            ?>
            <a href="<?php the_permalink(); ?>" class="group/item">
                <div class="relative rounded-24 overflow-hidden">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('large', array('class' => 'w-full h-320 object-cover')); ?>
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/article.webp" alt="" class="w-full h-320 object-cover">
                    <?php endif; ?>
                    <div class="absolute hidden inset-0 bg-black bg-opacity-30 lg:block lg:opacity-0 lg:transition group-hover/item:opacity-100"></div>
                    <div class="absolute top-20 left-20 flex items-center gap-12 text-blue-60 text-12 uppercase font-bold leading-none lg:transition lg:opacity-0 group-hover/item:opacity-100">
                        <?php
                        $categories = get_the_category();
                        foreach ($categories as $category) {
                            echo '<span class="bg-white bg-opacity-60 rounded-full px-8 py-6">' . $category->name . '</span>';
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
            else :
            ?>
            <div class="col-span-full text-center py-20">
                <p>No articles found.</p>
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
