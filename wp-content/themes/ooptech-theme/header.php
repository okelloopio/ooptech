<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'ooptech'); ?></a>

    <header id="masthead" class="site-header">
        <div class="container">
            <div class="header-content">
                <div class="site-branding">
                    <?php if (has_custom_logo()) : ?>
                        <div class="site-logo">
                            <?php the_custom_logo(); ?>
                        </div>
                    <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" rel="home">
                            <?php bloginfo('name'); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e('Primary Navigation', 'ooptech'); ?>">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'menu_class'     => 'nav-menu',
                        'container'      => false,
                        'fallback_cb'    => 'ooptech_default_menu',
                    ));
                    ?>
                    
                    <div class="header-actions">
                        <!-- Theme Toggle Button -->
                        <button id="theme-toggle" class="theme-toggle" aria-label="<?php esc_attr_e('Toggle dark mode', 'ooptech'); ?>">
                            <span class="light-icon">🌙</span>
                            <span class="dark-icon">☀️</span>
                        </button>
                        
                        <!-- Search Toggle Button -->
                        <button id="search-toggle" class="search-toggle" aria-label="<?php esc_attr_e('Open search', 'ooptech'); ?>">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.35-4.35"></path>
                            </svg>
                        </button>
                    </div>
                </nav>

                <!-- Mobile Menu Toggle -->
                <button class="mobile-menu-toggle" aria-controls="site-navigation" aria-expanded="false" aria-label="<?php esc_attr_e('Main Menu', 'ooptech'); ?>">
                    <span class="menu-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div>
        </div>

        <!-- Search Modal -->
        <div id="search-modal" class="search-modal">
            <div class="search-modal-content">
                <button id="search-close" class="search-close" aria-label="<?php esc_attr_e('Close search', 'ooptech'); ?>">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
                <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                    <label>
                        <span class="screen-reader-text"><?php echo _x('Search for:', 'label', 'ooptech'); ?></span>
                        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Search articles...', 'placeholder', 'ooptech'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                    </label>
                    <button type="submit" class="search-submit">
                        <?php echo esc_html_x('Search', 'submit button', 'ooptech'); ?>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <?php
    // Default menu fallback
    function ooptech_default_menu() {
        echo '<ul class="nav-menu">';
        echo '<li><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
        echo '<li><a href="' . esc_url(home_url('/blog/')) . '">Blog</a></li>';
        echo '<li><a href="' . esc_url(home_url('/about/')) . '">About</a></li>';
        echo '<li><a href="' . esc_url(home_url('/contact/')) . '">Contact</a></li>';
        echo '</ul>';
    }
    ?>

    <div id="content" class="site-content"><?php // This div is closed in footer.php ?>