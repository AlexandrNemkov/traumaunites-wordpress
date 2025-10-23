<?php
/**
 * The template for displaying all single posts
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
                <div class="entry-meta text-gray-600 text-sm">
                    <?php echo get_the_date(); ?> by <?php the_author(); ?>
                </div>
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="post-thumbnail mt-4">
                        <?php the_post_thumbnail('large', array('class' => 'w-full h-auto rounded-lg')); ?>
                    </div>
                <?php endif; ?>
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

            <footer class="entry-footer mt-6 border-t pt-4 text-gray-600 text-sm">
                <?php the_category(', '); ?>
                <?php the_tags('<span class="tags-links">', ', ', '</span>'); ?>
            </footer><!-- .entry-footer -->
        </article><!-- #post-<?php the_ID(); ?> -->
        <?php
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

    endwhile; // End of the loop.
    ?>
</main><!-- #main -->

<?php get_footer(); ?>
