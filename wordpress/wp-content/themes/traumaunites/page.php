<?php
/**
 * The template for displaying all pages
 */

get_header(); ?>

<main id="primary" class="site-main container mx-auto my-8">
    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white p-6 rounded-lg shadow-md'); ?>>
            <header class="entry-header mb-4">
                <?php the_title( '<h1 class="text-4xl font-bold text-gray-800 mb-2">', '</h1>' ); ?>
            </header><!-- .entry-header -->

            <div class="entry-content prose max-w-none">
                <?php
                the_content();
                wp_link_pages(
                    array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'traumaunites' ),
                        'after'  => '</div>',
                    )
                );
                ?>
            </div><!-- .entry-content -->
        </article><!-- #post-<?php the_ID(); ?> -->
        <?php
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

    endwhile; // End of the loop.
    ?>
</main><!-- #main -->

<?php get_footer(); ?>
