<?php
/**
 * Ooptech Theme Functions
 * 
 * @package OoptechTheme
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Theme Setup
function ooptech_setup() {
    // Add theme support for various features
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('responsive-embeds');
    add_theme_support('editor-styles');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    
    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-width'  => true,
        'flex-height' => true,
    ));
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'ooptech'),
        'footer'  => esc_html__('Footer Menu', 'ooptech'),
    ));
    
    // Add support for post formats
    add_theme_support('post-formats', array(
        'aside',
        'gallery',
        'link',
        'image',
        'quote',
        'status',
        'video',
        'audio',
        'chat'
    ));
    
    // Set content width
    $GLOBALS['content_width'] = 1200;
}
add_action('after_setup_theme', 'ooptech_setup');

// Enqueue styles and scripts
function ooptech_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style('ooptech-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Enqueue Google Fonts
    wp_enqueue_style('ooptech-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap', array(), null);
    
    // Enqueue main JavaScript
    wp_enqueue_script('ooptech-main', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true);
    
    // Enqueue comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    
    // Localize script for AJAX
    wp_localize_script('ooptech-main', 'ooptech_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('ooptech_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'ooptech_scripts');

// Register widget areas
function ooptech_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'ooptech'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'ooptech'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('Footer Area 1', 'ooptech'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add widgets here.', 'ooptech'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('Footer Area 2', 'ooptech'),
        'id'            => 'footer-2',
        'description'   => esc_html__('Add widgets here.', 'ooptech'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('Footer Area 3', 'ooptech'),
        'id'            => 'footer-3',
        'description'   => esc_html__('Add widgets here.', 'ooptech'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'ooptech_widgets_init');

// Custom excerpt length
function ooptech_excerpt_length($length) {
    return is_admin() ? $length : 25;
}
add_filter('excerpt_length', 'ooptech_excerpt_length', 999);

// Custom excerpt more
function ooptech_excerpt_more($more) {
    if (is_admin()) {
        return $more;
    }
    return '...';
}
add_filter('excerpt_more', 'ooptech_excerpt_more');

// Add custom image sizes
function ooptech_image_sizes() {
    add_image_size('ooptech-featured', 800, 400, true);
    add_image_size('ooptech-thumbnail', 350, 200, true);
    add_image_size('ooptech-large', 1200, 600, true);
}
add_action('after_setup_theme', 'ooptech_image_sizes');

// Custom post meta functions
function ooptech_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if (get_the_time('U') !== get_the_modified_time('U')) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf($time_string,
        esc_attr(get_the_date(DATE_W3C)),
        esc_html(get_the_date()),
        esc_attr(get_the_modified_date(DATE_W3C)),
        esc_html(get_the_modified_date())
    );

    $posted_on = sprintf(
        esc_html_x('Posted on %s', 'post date', 'ooptech'),
        '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
    );

    echo '<span class="posted-on">' . $posted_on . '</span>';
}

function ooptech_posted_by() {
    $byline = sprintf(
        esc_html_x('by %s', 'post author', 'ooptech'),
        '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
    );

    echo '<span class="byline"> ' . $byline . '</span>';
}

// Get reading time
function ooptech_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200);
    
    return $reading_time . ' min read';
}

// Social share functions
function ooptech_social_share() {
    $url = urlencode(get_permalink());
    $title = urlencode(get_the_title());
    
    $twitter_url = 'https://twitter.com/intent/tweet?text=' . $title . '&url=' . $url;
    $facebook_url = 'https://www.facebook.com/sharer/sharer.php?u=' . $url;
    $linkedin_url = 'https://www.linkedin.com/sharing/share-offsite/?url=' . $url;
    
    echo '<div class="social-share">';
    echo '<a href="' . $twitter_url . '" class="share-btn share-twitter" target="_blank" rel="noopener">Twitter</a>';
    echo '<a href="' . $facebook_url . '" class="share-btn share-facebook" target="_blank" rel="noopener">Facebook</a>';
    echo '<a href="' . $linkedin_url . '" class="share-btn share-linkedin" target="_blank" rel="noopener">LinkedIn</a>';
    echo '</div>';
}

// Get related posts
function ooptech_related_posts($post_id, $number_posts = 3) {
    $categories = wp_get_post_categories($post_id);
    
    if (empty($categories)) {
        return false;
    }
    
    $args = array(
        'category__in'   => $categories,
        'post__not_in'   => array($post_id),
        'posts_per_page' => $number_posts,
        'post_status'    => 'publish',
        'orderby'        => 'rand'
    );
    
    return new WP_Query($args);
}

// Custom comment form
function ooptech_comment_form() {
    $commenter = wp_get_current_commenter();
    $req = get_option('require_name_email');
    $aria_req = ($req ? " aria-required='true'" : '');
    
    $fields = array(
        'author' => '<div class="form-group"><label for="author">' . __('Name', 'ooptech') . ($req ? ' <span class="required">*</span>' : '') . '</label>' .
                   '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></div>',
        'email'  => '<div class="form-group"><label for="email">' . __('Email', 'ooptech') . ($req ? ' <span class="required">*</span>' : '') . '</label>' .
                   '<input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></div>',
        'url'    => '<div class="form-group"><label for="url">' . __('Website', 'ooptech') . '</label>' .
                   '<input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></div>',
    );
    
    $args = array(
        'fields'               => $fields,
        'comment_field'        => '<div class="form-group"><label for="comment">' . _x('Comment', 'noun', 'ooptech') . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>',
        'must_log_in'          => '<p class="must-log-in">' . sprintf(__('You must be <a href="%s">logged in</a> to post a comment.', 'ooptech'), wp_login_url(apply_filters('the_permalink', get_permalink()))) . '</p>',
        'logged_in_as'         => '<p class="logged-in-as">' . sprintf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'ooptech'), get_edit_user_link(), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink()))) . '</p>',
        'comment_notes_before' => '<p class="comment-notes"><span id="email-notes">' . __('Your email address will not be published.', 'ooptech') . '</span></p>',
        'comment_notes_after'  => '',
        'id_form'              => 'commentform',
        'id_submit'            => 'submit',
        'class_submit'         => 'btn btn-primary',
        'name_submit'          => 'submit',
        'title_reply'          => __('Leave a Reply', 'ooptech'),
        'title_reply_to'       => __('Leave a Reply to %s', 'ooptech'),
        'cancel_reply_link'    => __('Cancel Reply', 'ooptech'),
        'label_submit'         => __('Post Comment', 'ooptech'),
        'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
        'submit_field'         => '<div class="form-submit">%1$s %2$s</div>',
        'format'               => 'xhtml',
    );
    
    return $args;
}

// Newsletter subscription handler
function ooptech_newsletter_signup() {
    check_ajax_referer('ooptech_nonce', 'nonce');
    
    $email = sanitize_email($_POST['email']);
    
    if (!is_email($email)) {
        wp_die(json_encode(array('success' => false, 'message' => 'Invalid email address')));
    }
    
    // Here you would integrate with your email service (Mailchimp, etc.)
    // For now, we'll just store in the database
    
    global $wpdb;
    $table_name = $wpdb->prefix . 'newsletter_subscribers';
    
    $result = $wpdb->insert(
        $table_name,
        array(
            'email' => $email,
            'date_subscribed' => current_time('mysql')
        )
    );
    
    if ($result) {
        wp_die(json_encode(array('success' => true, 'message' => 'Successfully subscribed!')));
    } else {
        wp_die(json_encode(array('success' => false, 'message' => 'Subscription failed. Please try again.')));
    }
}
add_action('wp_ajax_newsletter_signup', 'ooptech_newsletter_signup');
add_action('wp_ajax_nopriv_newsletter_signup', 'ooptech_newsletter_signup');

// Create newsletter table on theme activation
function ooptech_create_newsletter_table() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'newsletter_subscribers';
    
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        email varchar(100) NOT NULL,
        date_subscribed datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY email (email)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'ooptech_create_newsletter_table');

// Admin customizations
function ooptech_admin_styles() {
    echo '<style>
        .admin-color-scheme {
            --wp-admin-theme-color: #2563eb;
            --wp-admin-theme-color-darker-10: #1d4ed8;
        }
    </style>';
}
add_action('admin_head', 'ooptech_admin_styles');

// Customizer additions
function ooptech_customize_register($wp_customize) {
    // Hero Section
    $wp_customize->add_section('ooptech_hero', array(
        'title'    => __('Hero Section', 'ooptech'),
        'priority' => 30,
    ));
    
    $wp_customize->add_setting('hero_title', array(
        'default'           => 'Welcome to Ooptech',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_title', array(
        'label'   => __('Hero Title', 'ooptech'),
        'section' => 'ooptech_hero',
        'type'    => 'text',
    ));
    
    $wp_customize->add_setting('hero_subtitle', array(
        'default'           => 'Your source for programming, tech trends, and startup insights',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('hero_subtitle', array(
        'label'   => __('Hero Subtitle', 'ooptech'),
        'section' => 'ooptech_hero',
        'type'    => 'textarea',
    ));
    
    // Social Media Links
    $wp_customize->add_section('ooptech_social', array(
        'title'    => __('Social Media', 'ooptech'),
        'priority' => 35,
    ));
    
    $social_networks = array('twitter', 'facebook', 'linkedin', 'github', 'youtube');
    
    foreach ($social_networks as $network) {
        $wp_customize->add_setting($network . '_url', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control($network . '_url', array(
            'label'   => sprintf(__('%s URL', 'ooptech'), ucfirst($network)),
            'section' => 'ooptech_social',
            'type'    => 'url',
        ));
    }
}
add_action('customize_register', 'ooptech_customize_register');

// Contact form handler
function ooptech_contact_form_handler() {
    if ($_POST['contact_form_submit']) {
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $subject = sanitize_text_field($_POST['subject']);
        $message = sanitize_textarea_field($_POST['message']);
        
        if (empty($name) || empty($email) || empty($message)) {
            return 'Please fill in all required fields.';
        }
        
        if (!is_email($email)) {
            return 'Please enter a valid email address.';
        }
        
        $to = get_option('admin_email');
        $subject = 'Contact Form: ' . $subject;
        $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
        $headers = array('Reply-To: ' . $email);
        
        if (wp_mail($to, $subject, $body, $headers)) {
            return 'success';
        } else {
            return 'Sorry, there was an error sending your message. Please try again.';
        }
    }
    
    return false;
}

// Security enhancements
function ooptech_security_headers() {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('X-XSS-Protection: 1; mode=block');
}
add_action('send_headers', 'ooptech_security_headers');

// Performance optimizations
function ooptech_remove_emoji_scripts() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'ooptech_remove_emoji_scripts');

// Clean up WordPress head
function ooptech_cleanup_head() {
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
}
add_action('init', 'ooptech_cleanup_head');