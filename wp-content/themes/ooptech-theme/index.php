<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 *
 * @package OoptechTheme
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php if (is_home() && !is_paged()) : ?>
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <div class="hero-content">
                    <h1><?php echo esc_html(get_theme_mod('hero_title', 'Welcome to Ooptech')); ?></h1>
                    <p><?php echo esc_html(get_theme_mod('hero_subtitle', 'Your source for programming, tech trends, and startup insights')); ?></p>
                    <div class="hero-actions">
                        <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="btn btn-primary"><?php esc_html_e('Explore Articles', 'ooptech'); ?></a>
                        <a href="<?php echo esc_url(home_url('/about/')); ?>" class="btn btn-secondary"><?php esc_html_e('Learn More', 'ooptech'); ?></a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Categories Section -->
        <section class="featured-categories">
            <div class="container">
                <h2 class="text-center"><?php esc_html_e('Explore Our Categories', 'ooptech'); ?></h2>
                <div class="categories-grid">
                    <?php
                    $categories = get_categories(array(
                        'orderby' => 'count',
                        'order'   => 'DESC',
                        'number'  => 6,
                        'hide_empty' => true,
                    ));

                    foreach ($categories as $category) :
                        $category_link = get_category_link($category->term_id);
                        $category_color = get_term_meta($category->term_id, 'category_color', true) ?: '#2563eb';
                    ?>
                        <div class="category-card">
                            <a href="<?php echo esc_url($category_link); ?>" class="category-link">
                                <div class="category-icon" style="background-color: <?php echo esc_attr($category_color); ?>">
                                    <?php echo esc_html(substr($category->name, 0, 1)); ?>
                                </div>
                                <h3><?php echo esc_html($category->name); ?></h3>
                                <p><?php echo esc_html($category->description); ?></p>
                                <span class="post-count"><?php echo esc_html($category->count); ?> <?php esc_html_e('posts', 'ooptech'); ?></span>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Latest Posts Section -->
    <section class="latest-posts">
        <div class="container">
            <?php if (is_home() && !is_paged()) : ?>
                <h2 class="text-center"><?php esc_html_e('Latest Articles', 'ooptech'); ?></h2>
            <?php endif; ?>

            <?php if (have_posts()) : ?>
                <div class="posts-grid">
                    <?php
                    while (have_posts()) :
                        the_post();
                    ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail-wrapper">
                                    <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                                        <?php the_post_thumbnail('ooptech-thumbnail', array('class' => 'post-thumbnail')); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <div class="post-content">
                                <div class="post-meta">
                                    <span class="post-category">
                                        <?php
                                        $categories = get_the_category();
                                        if (!empty($categories)) {
                                            echo esc_html($categories[0]->name);
                                        }
                                        ?>
                                    </span>
                                    <span class="post-date"><?php echo get_the_date(); ?></span>
                                    <span class="reading-time"><?php echo ooptech_reading_time(); ?></span>
                                </div>

                                <h2 class="post-title">
                                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>

                                <div class="post-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>

                                <div class="post-footer">
                                    <div class="post-author">
                                        <?php echo get_avatar(get_the_author_meta('ID'), 32); ?>
                                        <span><?php echo esc_html(get_the_author()); ?></span>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" class="read-more">
                                        <?php esc_html_e('Read More', 'ooptech'); ?>
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="7" y1="17" x2="17" y2="7"></line>
                                            <polyline points="7,7 17,7 17,17"></polyline>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    <?php
                    the_posts_pagination(array(
                        'mid_size'  => 2,
                        'prev_text' => __('← Previous', 'ooptech'),
                        'next_text' => __('Next →', 'ooptech'),
                    ));
                    ?>
                </div>

            <?php else : ?>
                <div class="no-posts">
                    <div class="container">
                        <h2><?php esc_html_e('No posts found', 'ooptech'); ?></h2>
                        <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'ooptech'); ?></p>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary"><?php esc_html_e('Back to Home', 'ooptech'); ?></a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>