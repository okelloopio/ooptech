<?php
/**
 * The template for displaying all single posts
 *
 * @package OoptechTheme
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
            
            <!-- Post Header -->
            <header class="post-header">
                <div class="container">
                    <div class="post-meta">
                        <span class="post-category">
                            <?php
                            $categories = get_the_category();
                            if (!empty($categories)) {
                                echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>';
                            }
                            ?>
                        </span>
                        <span class="post-date"><?php echo get_the_date(); ?></span>
                        <span class="reading-time"><?php echo ooptech_reading_time(); ?></span>
                    </div>

                    <h1 class="post-title"><?php the_title(); ?></h1>

                    <div class="post-author-meta">
                        <div class="author-info">
                            <?php echo get_avatar(get_the_author_meta('ID'), 40); ?>
                            <div class="author-details">
                                <span class="author-name">
                                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                        <?php echo esc_html(get_the_author()); ?>
                                    </a>
                                </span>
                                <span class="author-role"><?php echo esc_html(get_the_author_meta('description') ?: 'Author'); ?></span>
                            </div>
                        </div>
                    </div>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-featured-image">
                            <?php the_post_thumbnail('ooptech-large', array('class' => 'featured-image')); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </header>

            <!-- Post Content -->
            <div class="post-content-single">
                <div class="container">
                    <?php the_content(); ?>

                    <?php
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'ooptech'),
                        'after'  => '</div>',
                    ));
                    ?>

                    <!-- Tags -->
                    <?php if (has_tag()) : ?>
                        <div class="post-tags">
                            <h4><?php esc_html_e('Tags:', 'ooptech'); ?></h4>
                            <div class="tags-list">
                                <?php
                                $tags = get_the_tags();
                                foreach ($tags as $tag) {
                                    echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="tag-link">' . esc_html($tag->name) . '</a>';
                                }
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Social Share Buttons -->
                    <div class="social-share-section">
                        <h4><?php esc_html_e('Share this article:', 'ooptech'); ?></h4>
                        <?php ooptech_social_share(); ?>
                    </div>
                </div>
            </div>

            <!-- Author Bio -->
            <?php
            $author_bio = get_the_author_meta('description');
            if ($author_bio) :
            ?>
                <div class="author-bio">
                    <div class="container">
                        <div class="author-bio-content">
                            <?php echo get_avatar(get_the_author_meta('ID'), 80, '', '', array('class' => 'author-avatar')); ?>
                            <div class="author-info">
                                <h4><?php esc_html_e('About', 'ooptech'); ?> <?php echo esc_html(get_the_author()); ?></h4>
                                <p><?php echo esc_html($author_bio); ?></p>
                                <div class="author-links">
                                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="btn btn-secondary">
                                        <?php esc_html_e('View all posts', 'ooptech'); ?>
                                    </a>
                                    <?php if (get_the_author_meta('user_url')) : ?>
                                        <a href="<?php echo esc_url(get_the_author_meta('user_url')); ?>" target="_blank" rel="noopener" class="btn btn-secondary">
                                            <?php esc_html_e('Website', 'ooptech'); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Related Posts -->
            <?php
            $related_posts = ooptech_related_posts(get_the_ID(), 3);
            if ($related_posts && $related_posts->have_posts()) :
            ?>
                <div class="related-posts">
                    <div class="container">
                        <h3><?php esc_html_e('Related Articles', 'ooptech'); ?></h3>
                        <div class="posts-grid">
                            <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                                <article class="post-card">
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
                                        </div>

                                        <h4 class="post-title">
                                            <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                <?php the_title(); ?>
                                            </a>
                                        </h4>

                                        <div class="post-excerpt">
                                            <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                                        </div>

                                        <a href="<?php the_permalink(); ?>" class="read-more">
                                            <?php esc_html_e('Read More', 'ooptech'); ?>
                                        </a>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>

            <!-- Post Navigation -->
            <div class="post-navigation">
                <div class="container">
                    <?php
                    the_post_navigation(array(
                        'prev_text' => '<span class="nav-direction">' . esc_html__('Previous Post', 'ooptech') . '</span><span class="nav-title">%title</span>',
                        'next_text' => '<span class="nav-direction">' . esc_html__('Next Post', 'ooptech') . '</span><span class="nav-title">%title</span>',
                    ));
                    ?>
                </div>
            </div>

        </article>

        <!-- Comments Section -->
        <?php if (comments_open() || get_comments_number()) : ?>
            <div class="comments-section">
                <div class="container">
                    <?php comments_template(); ?>
                </div>
            </div>
        <?php endif; ?>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>