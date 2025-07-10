    </div><!-- #content -->

    <!-- Newsletter Signup Section -->
    <section class="newsletter-signup">
        <div class="container">
            <h3><?php esc_html_e('Stay Updated with Ooptech', 'ooptech'); ?></h3>
            <p><?php esc_html_e('Get the latest tech insights, programming tutorials, and startup stories delivered to your inbox.', 'ooptech'); ?></p>
            <form id="newsletter-form" class="newsletter-form">
                <input type="email" name="email" class="newsletter-input" placeholder="<?php esc_attr_e('Enter your email address', 'ooptech'); ?>" required>
                <button type="submit" class="btn btn-primary"><?php esc_html_e('Subscribe', 'ooptech'); ?></button>
            </form>
            <div id="newsletter-message"></div>
        </div>
    </section>

    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h4><?php esc_html_e('About Ooptech', 'ooptech'); ?></h4>
                    <p><?php esc_html_e('Your trusted source for cutting-edge programming insights, tech trends, and startup culture. We help developers and tech enthusiasts stay ahead of the curve.', 'ooptech'); ?></p>
                    
                    <!-- Social Media Links -->
                    <div class="social-links">
                        <?php
                        $social_networks = array(
                            'twitter' => array('Twitter', 'https://twitter.com/'),
                            'facebook' => array('Facebook', 'https://facebook.com/'),
                            'linkedin' => array('LinkedIn', 'https://linkedin.com/'),
                            'github' => array('GitHub', 'https://github.com/'),
                            'youtube' => array('YouTube', 'https://youtube.com/')
                        );
                        
                        foreach ($social_networks as $network => $data) {
                            $url = get_theme_mod($network . '_url');
                            if ($url) {
                                echo '<a href="' . esc_url($url) . '" target="_blank" rel="noopener" aria-label="' . esc_attr($data[0]) . '">';
                                echo '<span class="social-' . $network . '">' . $data[0] . '</span>';
                                echo '</a>';
                            }
                        }
                        ?>
                    </div>
                </div>

                <?php if (is_active_sidebar('footer-1')) : ?>
                <div class="footer-section">
                    <?php dynamic_sidebar('footer-1'); ?>
                </div>
                <?php else : ?>
                <div class="footer-section">
                    <h4><?php esc_html_e('Categories', 'ooptech'); ?></h4>
                    <ul>
                        <li><a href="<?php echo esc_url(get_category_link(get_cat_ID('Programming'))); ?>"><?php esc_html_e('Programming', 'ooptech'); ?></a></li>
                        <li><a href="<?php echo esc_url(get_category_link(get_cat_ID('AI & Machine Learning'))); ?>"><?php esc_html_e('AI & Machine Learning', 'ooptech'); ?></a></li>
                        <li><a href="<?php echo esc_url(get_category_link(get_cat_ID('Tutorials'))); ?>"><?php esc_html_e('Tutorials', 'ooptech'); ?></a></li>
                        <li><a href="<?php echo esc_url(get_category_link(get_cat_ID('Startups'))); ?>"><?php esc_html_e('Startups', 'ooptech'); ?></a></li>
                        <li><a href="<?php echo esc_url(get_category_link(get_cat_ID('Tech Trends'))); ?>"><?php esc_html_e('Tech Trends', 'ooptech'); ?></a></li>
                    </ul>
                </div>
                <?php endif; ?>

                <?php if (is_active_sidebar('footer-2')) : ?>
                <div class="footer-section">
                    <?php dynamic_sidebar('footer-2'); ?>
                </div>
                <?php else : ?>
                <div class="footer-section">
                    <h4><?php esc_html_e('Quick Links', 'ooptech'); ?></h4>
                    <ul>
                        <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'ooptech'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/blog/')); ?>"><?php esc_html_e('Blog', 'ooptech'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/about/')); ?>"><?php esc_html_e('About', 'ooptech'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/contact/')); ?>"><?php esc_html_e('Contact', 'ooptech'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>"><?php esc_html_e('Privacy Policy', 'ooptech'); ?></a></li>
                    </ul>
                </div>
                <?php endif; ?>

                <?php if (is_active_sidebar('footer-3')) : ?>
                <div class="footer-section">
                    <?php dynamic_sidebar('footer-3'); ?>
                </div>
                <?php else : ?>
                <div class="footer-section">
                    <h4><?php esc_html_e('Contact Info', 'ooptech'); ?></h4>
                    <p><?php esc_html_e('Email:', 'ooptech'); ?> <a href="mailto:hello@ooptech.com">hello@ooptech.com</a></p>
                    <p><?php esc_html_e('For partnerships and collaborations, reach out to us.', 'ooptech'); ?></p>
                    
                    <h4><?php esc_html_e('Latest Posts', 'ooptech'); ?></h4>
                    <?php
                    $recent_posts = wp_get_recent_posts(array(
                        'numberposts' => 3,
                        'post_status' => 'publish'
                    ), OBJECT);
                    
                    if ($recent_posts) {
                        echo '<ul>';
                        foreach ($recent_posts as $post) {
                            echo '<li><a href="' . get_permalink($post->ID) . '">' . esc_html($post->post_title) . '</a></li>';
                        }
                        echo '</ul>';
                    }
                    ?>
                </div>
                <?php endif; ?>
            </div>

            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('All rights reserved.', 'ooptech'); ?></p>
                    <p><?php esc_html_e('Built with passion for technology and innovation.', 'ooptech'); ?></p>
                </div>
            </div>
        </div>
    </footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>