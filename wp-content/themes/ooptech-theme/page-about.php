<?php
/**
 * Template Name: About Page
 * 
 * The template for displaying the about page
 *
 * @package OoptechTheme
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('about-page'); ?>>
            
            <!-- Hero Section -->
            <header class="about-hero">
                <div class="container">
                    <div class="about-hero-content">
                        <div class="about-text">
                            <h1 class="page-title"><?php the_title(); ?></h1>
                            <p class="about-subtitle"><?php esc_html_e('Empowering developers and tech enthusiasts with cutting-edge insights, practical tutorials, and startup wisdom.', 'ooptech'); ?></p>
                        </div>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="about-image">
                                <?php the_post_thumbnail('ooptech-large', array('class' => 'about-featured-image')); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </header>

            <!-- Mission Section -->
            <section class="mission-section">
                <div class="container">
                    <div class="mission-grid">
                        <div class="mission-content">
                            <h2><?php esc_html_e('Our Mission', 'ooptech'); ?></h2>
                            <p><?php esc_html_e('At Ooptech, we believe that technology should be accessible, understandable, and transformative. Our mission is to bridge the gap between complex technical concepts and practical implementation, helping developers, entrepreneurs, and tech enthusiasts stay ahead in the rapidly evolving digital landscape.', 'ooptech'); ?></p>
                            
                            <div class="mission-stats">
                                <div class="stat-item">
                                    <h3>50K+</h3>
                                    <p><?php esc_html_e('Monthly Readers', 'ooptech'); ?></p>
                                </div>
                                <div class="stat-item">
                                    <h3>500+</h3>
                                    <p><?php esc_html_e('Articles Published', 'ooptech'); ?></p>
                                </div>
                                <div class="stat-item">
                                    <h3>25+</h3>
                                    <p><?php esc_html_e('Expert Contributors', 'ooptech'); ?></p>
                                </div>
                                <div class="stat-item">
                                    <h3>2019</h3>
                                    <p><?php esc_html_e('Year Founded', 'ooptech'); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="mission-values">
                            <div class="value-item">
                                <div class="value-icon">🎯</div>
                                <h3><?php esc_html_e('Quality First', 'ooptech'); ?></h3>
                                <p><?php esc_html_e('Every article is thoroughly researched, tested, and reviewed by industry experts to ensure accuracy and practical value.', 'ooptech'); ?></p>
                            </div>

                            <div class="value-item">
                                <div class="value-icon">🚀</div>
                                <h3><?php esc_html_e('Innovation Focus', 'ooptech'); ?></h3>
                                <p><?php esc_html_e('We stay at the forefront of emerging technologies, bringing you insights on the latest trends and breakthrough innovations.', 'ooptech'); ?></p>
                            </div>

                            <div class="value-item">
                                <div class="value-icon">🤝</div>
                                <h3><?php esc_html_e('Community Driven', 'ooptech'); ?></h3>
                                <p><?php esc_html_e('Our content is shaped by our community\'s needs, questions, and feedback, ensuring we address real-world challenges.', 'ooptech'); ?></p>
                            </div>

                            <div class="value-item">
                                <div class="value-icon">🌍</div>
                                <h3><?php esc_html_e('Global Perspective', 'ooptech'); ?></h3>
                                <p><?php esc_html_e('We feature insights from developers and entrepreneurs worldwide, providing diverse perspectives on tech and innovation.', 'ooptech'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- What We Cover Section -->
            <section class="coverage-section">
                <div class="container">
                    <h2 class="text-center"><?php esc_html_e('What We Cover', 'ooptech'); ?></h2>
                    <div class="coverage-grid">
                        <div class="coverage-item">
                            <div class="coverage-icon">👨‍💻</div>
                            <h3><?php esc_html_e('Programming & Development', 'ooptech'); ?></h3>
                            <p><?php esc_html_e('In-depth tutorials, best practices, and advanced techniques across multiple programming languages and frameworks.', 'ooptech'); ?></p>
                        </div>

                        <div class="coverage-item">
                            <div class="coverage-icon">🤖</div>
                            <h3><?php esc_html_e('AI & Machine Learning', 'ooptech'); ?></h3>
                            <p><?php esc_html_e('Cutting-edge insights into artificial intelligence, machine learning algorithms, and practical AI applications.', 'ooptech'); ?></p>
                        </div>

                        <div class="coverage-item">
                            <div class="coverage-icon">🏢</div>
                            <h3><?php esc_html_e('Startup Culture', 'ooptech'); ?></h3>
                            <p><?php esc_html_e('Entrepreneurial insights, startup strategies, and lessons learned from successful tech entrepreneurs.', 'ooptech'); ?></p>
                        </div>

                        <div class="coverage-item">
                            <div class="coverage-icon">📈</div>
                            <h3><?php esc_html_e('Tech Trends', 'ooptech'); ?></h3>
                            <p><?php esc_html_e('Analysis of emerging technologies, market trends, and predictions for the future of tech.', 'ooptech'); ?></p>
                        </div>

                        <div class="coverage-item">
                            <div class="coverage-icon">🛠️</div>
                            <h3><?php esc_html_e('Tools & Resources', 'ooptech'); ?></h3>
                            <p><?php esc_html_e('Reviews and recommendations of development tools, software, and resources to boost productivity.', 'ooptech'); ?></p>
                        </div>

                        <div class="coverage-item">
                            <div class="coverage-icon">💡</div>
                            <h3><?php esc_html_e('Innovation Stories', 'ooptech'); ?></h3>
                            <p><?php esc_html_e('Inspiring stories of technological breakthroughs and the people behind groundbreaking innovations.', 'ooptech'); ?></p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Team Section -->
            <section class="team-section">
                <div class="container">
                    <h2 class="text-center"><?php esc_html_e('Meet Our Team', 'ooptech'); ?></h2>
                    <p class="team-intro text-center"><?php esc_html_e('Our diverse team of writers, developers, and tech enthusiasts brings decades of combined experience in software development, entrepreneurship, and technical writing.', 'ooptech'); ?></p>
                    
                    <div class="team-grid">
                        <div class="team-member">
                            <div class="member-photo">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300&h=300&fit=crop&crop=face" alt="Alex Chen" loading="lazy">
                            </div>
                            <div class="member-info">
                                <h3>Alex Chen</h3>
                                <p class="member-role"><?php esc_html_e('Founder & Lead Editor', 'ooptech'); ?></p>
                                <p class="member-bio"><?php esc_html_e('Full-stack developer with 10+ years of experience. Former tech lead at major startups, passionate about making complex technologies accessible.', 'ooptech'); ?></p>
                                <div class="member-social">
                                    <a href="#" class="social-link">LinkedIn</a>
                                    <a href="#" class="social-link">Twitter</a>
                                    <a href="#" class="social-link">GitHub</a>
                                </div>
                            </div>
                        </div>

                        <div class="team-member">
                            <div class="member-photo">
                                <img src="https://images.unsplash.com/photo-1494790108755-2616b612b977?w=300&h=300&fit=crop&crop=face" alt="Sarah Johnson" loading="lazy">
                            </div>
                            <div class="member-info">
                                <h3>Sarah Johnson</h3>
                                <p class="member-role"><?php esc_html_e('AI & ML Specialist', 'ooptech'); ?></p>
                                <p class="member-bio"><?php esc_html_e('Data scientist and machine learning engineer. PhD in Computer Science, specializing in deep learning and AI applications in business.', 'ooptech'); ?></p>
                                <div class="member-social">
                                    <a href="#" class="social-link">LinkedIn</a>
                                    <a href="#" class="social-link">Research</a>
                                </div>
                            </div>
                        </div>

                        <div class="team-member">
                            <div class="member-photo">
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=300&h=300&fit=crop&crop=face" alt="Marcus Rodriguez" loading="lazy">
                            </div>
                            <div class="member-info">
                                <h3>Marcus Rodriguez</h3>
                                <p class="member-role"><?php esc_html_e('Startup Advisor', 'ooptech'); ?></p>
                                <p class="member-bio"><?php esc_html_e('Serial entrepreneur with 3 successful exits. Investor and mentor to early-stage tech startups. Expert in scaling and product development.', 'ooptech'); ?></p>
                                <div class="member-social">
                                    <a href="#" class="social-link">LinkedIn</a>
                                    <a href="#" class="social-link">Medium</a>
                                </div>
                            </div>
                        </div>

                        <div class="team-member">
                            <div class="member-photo">
                                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=300&h=300&fit=crop&crop=face" alt="Emily Davis" loading="lazy">
                            </div>
                            <div class="member-info">
                                <h3>Emily Davis</h3>
                                <p class="member-role"><?php esc_html_e('Technical Writer', 'ooptech'); ?></p>
                                <p class="member-bio"><?php esc_html_e('Technical communication expert with a background in software development. Specializes in making complex technical concepts clear and actionable.', 'ooptech'); ?></p>
                                <div class="member-social">
                                    <a href="#" class="social-link">LinkedIn</a>
                                    <a href="#" class="social-link">Portfolio</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Page Content -->
            <?php if (get_the_content()) : ?>
                <section class="page-content-section">
                    <div class="container">
                        <div class="page-content-inner">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <!-- Join Us Section -->
            <section class="join-section">
                <div class="container">
                    <div class="join-content">
                        <h2><?php esc_html_e('Join Our Community', 'ooptech'); ?></h2>
                        <p><?php esc_html_e('Whether you\'re a seasoned developer, aspiring entrepreneur, or tech enthusiast, there\'s a place for you in the Ooptech community.', 'ooptech'); ?></p>
                        <div class="join-actions">
                            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary"><?php esc_html_e('Get Involved', 'ooptech'); ?></a>
                            <a href="#newsletter-form" class="btn btn-secondary"><?php esc_html_e('Subscribe to Newsletter', 'ooptech'); ?></a>
                        </div>
                    </div>
                </div>
            </section>

        </article>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>