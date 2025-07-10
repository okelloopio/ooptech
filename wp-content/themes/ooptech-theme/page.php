<?php
/**
 * The template for displaying all pages
 *
 * @package OoptechTheme
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>
            
            <?php if (has_post_thumbnail()) : ?>
                <div class="page-header-image">
                    <div class="container">
                        <?php the_post_thumbnail('ooptech-large', array('class' => 'page-featured-image')); ?>
                    </div>
                </div>
            <?php endif; ?>

            <header class="page-header">
                <div class="container">
                    <h1 class="page-title"><?php the_title(); ?></h1>
                    <?php if (get_the_excerpt()) : ?>
                        <div class="page-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </header>

            <div class="page-content-wrapper">
                <div class="container">
                    <div class="page-content-inner">
                        <?php the_content(); ?>

                        <?php
                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'ooptech'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>
                </div>
            </div>

        </article>

        <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
        ?>
            <div class="comments-section">
                <div class="container">
                    <?php comments_template(); ?>
                </div>
            </div>
        <?php endif; ?>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>