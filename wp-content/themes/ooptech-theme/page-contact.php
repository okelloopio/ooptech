<?php
/**
 * Template Name: Contact Page
 * 
 * The template for displaying the contact page with contact form
 *
 * @package OoptechTheme
 */

get_header();

// Handle form submission
$form_message = '';
if ($_POST['contact_form_submit']) {
    $form_message = ooptech_contact_form_handler();
}
?>

<main id="primary" class="site-main">

    <?php while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('contact-page'); ?>>
            
            <header class="page-header">
                <div class="container">
                    <h1 class="page-title"><?php the_title(); ?></h1>
                    <div class="page-subtitle">
                        <p><?php esc_html_e('Get in touch with the Ooptech team. We\'d love to hear from you!', 'ooptech'); ?></p>
                    </div>
                </div>
            </header>

            <div class="contact-content">
                <div class="container">
                    <div class="contact-grid">
                        
                        <!-- Contact Information -->
                        <div class="contact-info">
                            <h2><?php esc_html_e('Contact Information', 'ooptech'); ?></h2>
                            
                            <div class="contact-item">
                                <h3><?php esc_html_e('Email', 'ooptech'); ?></h3>
                                <p><a href="mailto:hello@ooptech.com">hello@ooptech.com</a></p>
                                <small><?php esc_html_e('For general inquiries and partnerships', 'ooptech'); ?></small>
                            </div>

                            <div class="contact-item">
                                <h3><?php esc_html_e('Editorial', 'ooptech'); ?></h3>
                                <p><a href="mailto:editorial@ooptech.com">editorial@ooptech.com</a></p>
                                <small><?php esc_html_e('For article submissions and guest posts', 'ooptech'); ?></small>
                            </div>

                            <div class="contact-item">
                                <h3><?php esc_html_e('Business', 'ooptech'); ?></h3>
                                <p><a href="mailto:business@ooptech.com">business@ooptech.com</a></p>
                                <small><?php esc_html_e('For business partnerships and collaborations', 'ooptech'); ?></small>
                            </div>

                            <div class="contact-item">
                                <h3><?php esc_html_e('Follow Us', 'ooptech'); ?></h3>
                                <div class="social-links">
                                    <?php
                                    $social_networks = array(
                                        'twitter' => array('Twitter', '🐦'),
                                        'linkedin' => array('LinkedIn', '💼'),
                                        'github' => array('GitHub', '👨‍💻'),
                                        'youtube' => array('YouTube', '📺')
                                    );
                                    
                                    foreach ($social_networks as $network => $data) {
                                        $url = get_theme_mod($network . '_url');
                                        if ($url) {
                                            echo '<a href="' . esc_url($url) . '" target="_blank" rel="noopener" class="social-link">';
                                            echo '<span class="social-icon">' . $data[1] . '</span> ' . $data[0];
                                            echo '</a>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="contact-item">
                                <h3><?php esc_html_e('Response Time', 'ooptech'); ?></h3>
                                <p><?php esc_html_e('We typically respond within 24-48 hours during business days.', 'ooptech'); ?></p>
                            </div>
                        </div>

                        <!-- Contact Form -->
                        <div class="contact-form-wrapper">
                            <h2><?php esc_html_e('Send us a Message', 'ooptech'); ?></h2>

                            <?php if ($form_message) : ?>
                                <div class="form-message <?php echo ($form_message === 'success') ? 'success' : 'error'; ?>">
                                    <?php if ($form_message === 'success') : ?>
                                        <p><?php esc_html_e('Thank you for your message! We\'ll get back to you soon.', 'ooptech'); ?></p>
                                    <?php else : ?>
                                        <p><?php echo esc_html($form_message); ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <form class="contact-form" method="post" action="">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="name"><?php esc_html_e('Name', 'ooptech'); ?> <span class="required">*</span></label>
                                        <input type="text" id="name" name="name" required value="<?php echo isset($_POST['name']) ? esc_attr($_POST['name']) : ''; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="email"><?php esc_html_e('Email', 'ooptech'); ?> <span class="required">*</span></label>
                                        <input type="email" id="email" name="email" required value="<?php echo isset($_POST['email']) ? esc_attr($_POST['email']) : ''; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="subject"><?php esc_html_e('Subject', 'ooptech'); ?></label>
                                    <select id="subject" name="subject">
                                        <option value=""><?php esc_html_e('Select a subject', 'ooptech'); ?></option>
                                        <option value="general" <?php selected(isset($_POST['subject']) ? $_POST['subject'] : '', 'general'); ?>>
                                            <?php esc_html_e('General Inquiry', 'ooptech'); ?>
                                        </option>
                                        <option value="partnership" <?php selected(isset($_POST['subject']) ? $_POST['subject'] : '', 'partnership'); ?>>
                                            <?php esc_html_e('Partnership Opportunity', 'ooptech'); ?>
                                        </option>
                                        <option value="guest-post" <?php selected(isset($_POST['subject']) ? $_POST['subject'] : '', 'guest-post'); ?>>
                                            <?php esc_html_e('Guest Post Submission', 'ooptech'); ?>
                                        </option>
                                        <option value="technical" <?php selected(isset($_POST['subject']) ? $_POST['subject'] : '', 'technical'); ?>>
                                            <?php esc_html_e('Technical Issue', 'ooptech'); ?>
                                        </option>
                                        <option value="feedback" <?php selected(isset($_POST['subject']) ? $_POST['subject'] : '', 'feedback'); ?>>
                                            <?php esc_html_e('Feedback', 'ooptech'); ?>
                                        </option>
                                        <option value="other" <?php selected(isset($_POST['subject']) ? $_POST['subject'] : '', 'other'); ?>>
                                            <?php esc_html_e('Other', 'ooptech'); ?>
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="message"><?php esc_html_e('Message', 'ooptech'); ?> <span class="required">*</span></label>
                                    <textarea id="message" name="message" rows="6" required placeholder="<?php esc_attr_e('Tell us about your project, question, or how we can help you...', 'ooptech'); ?>"><?php echo isset($_POST['message']) ? esc_textarea($_POST['message']) : ''; ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="newsletter" value="1" <?php checked(isset($_POST['newsletter']) ? $_POST['newsletter'] : '', '1'); ?>>
                                        <span class="checkmark"></span>
                                        <?php esc_html_e('Subscribe to our newsletter for tech insights and updates', 'ooptech'); ?>
                                    </label>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" name="contact_form_submit" class="btn btn-primary">
                                        <?php esc_html_e('Send Message', 'ooptech'); ?>
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="22" y1="2" x2="11" y2="13"></line>
                                            <polygon points="22,2 15,22 11,13 2,9"></polygon>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Additional Content -->
                    <?php if (get_the_content()) : ?>
                        <div class="additional-content">
                            <?php the_content(); ?>
                        </div>
                    <?php endif; ?>

                    <!-- FAQ Section -->
                    <div class="contact-faq">
                        <h2><?php esc_html_e('Frequently Asked Questions', 'ooptech'); ?></h2>
                        <div class="faq-grid">
                            <div class="faq-item">
                                <h3><?php esc_html_e('Can I submit a guest post?', 'ooptech'); ?></h3>
                                <p><?php esc_html_e('Yes! We welcome high-quality guest posts on programming, tech trends, AI, and startup topics. Please email us with your pitch and writing samples.', 'ooptech'); ?></p>
                            </div>

                            <div class="faq-item">
                                <h3><?php esc_html_e('Do you offer consulting services?', 'ooptech'); ?></h3>
                                <p><?php esc_html_e('We occasionally provide consulting for tech startups and development teams. Contact us to discuss your specific needs.', 'ooptech'); ?></p>
                            </div>

                            <div class="faq-item">
                                <h3><?php esc_html_e('How can I sponsor content?', 'ooptech'); ?></h3>
                                <p><?php esc_html_e('We offer various sponsorship opportunities for relevant tech products and services. Reach out to our business team for more details.', 'ooptech'); ?></p>
                            </div>

                            <div class="faq-item">
                                <h3><?php esc_html_e('Can I request a specific topic?', 'ooptech'); ?></h3>
                                <p><?php esc_html_e('Absolutely! We love hearing what our readers want to learn about. Send us your topic suggestions and we\'ll consider them for future articles.', 'ooptech'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </article>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>