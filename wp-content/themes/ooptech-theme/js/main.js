/**
 * Ooptech Theme JavaScript
 * 
 * Handles theme functionality including:
 * - Dark/Light mode toggle
 * - Mobile navigation
 * - Search modal
 * - Newsletter subscription
 * - Smooth scrolling
 * - Reading progress indicator
 */

(function($) {
    'use strict';

    // Initialize when DOM is ready
    $(document).ready(function() {
        initializeTheme();
    });

    function initializeTheme() {
        initThemeToggle();
        initMobileMenu();
        initSearchModal();
        initNewsletterForm();
        initSmoothScrolling();
        initReadingProgress();
        initLazyLoading();
        initCodeHighlighting();
    }

    // Dark/Light Mode Toggle
    function initThemeToggle() {
        const themeToggle = document.getElementById('theme-toggle');
        const body = document.body;
        const lightIcon = themeToggle.querySelector('.light-icon');
        const darkIcon = themeToggle.querySelector('.dark-icon');

        // Check for saved theme preference or default to light mode
        const savedTheme = localStorage.getItem('ooptech-theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        const currentTheme = savedTheme || (prefersDark ? 'dark' : 'light');

        // Apply initial theme
        applyTheme(currentTheme);

        // Toggle theme on button click
        themeToggle.addEventListener('click', function() {
            const currentTheme = body.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            applyTheme(newTheme);
            localStorage.setItem('ooptech-theme', newTheme);
        });

        function applyTheme(theme) {
            body.setAttribute('data-theme', theme);
            
            if (theme === 'dark') {
                lightIcon.style.display = 'none';
                darkIcon.style.display = 'inline';
            } else {
                lightIcon.style.display = 'inline';
                darkIcon.style.display = 'none';
            }
        }

        // Listen for system theme changes
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
            if (!localStorage.getItem('ooptech-theme')) {
                applyTheme(e.matches ? 'dark' : 'light');
            }
        });
    }

    // Mobile Menu
    function initMobileMenu() {
        const mobileToggle = document.querySelector('.mobile-menu-toggle');
        const navigation = document.querySelector('.main-navigation');
        const body = document.body;

        if (mobileToggle && navigation) {
            mobileToggle.addEventListener('click', function() {
                const isExpanded = mobileToggle.getAttribute('aria-expanded') === 'true';
                
                mobileToggle.setAttribute('aria-expanded', !isExpanded);
                navigation.classList.toggle('active');
                body.classList.toggle('menu-open');
            });

            // Close menu when clicking outside
            document.addEventListener('click', function(e) {
                if (!navigation.contains(e.target) && !mobileToggle.contains(e.target)) {
                    mobileToggle.setAttribute('aria-expanded', 'false');
                    navigation.classList.remove('active');
                    body.classList.remove('menu-open');
                }
            });

            // Close menu on window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    mobileToggle.setAttribute('aria-expanded', 'false');
                    navigation.classList.remove('active');
                    body.classList.remove('menu-open');
                }
            });
        }
    }

    // Search Modal
    function initSearchModal() {
        const searchToggle = document.getElementById('search-toggle');
        const searchModal = document.getElementById('search-modal');
        const searchClose = document.getElementById('search-close');
        const searchField = searchModal?.querySelector('.search-field');
        const body = document.body;

        if (searchToggle && searchModal) {
            // Open search modal
            searchToggle.addEventListener('click', function() {
                searchModal.classList.add('active');
                body.classList.add('search-open');
                searchField?.focus();
            });

            // Close search modal
            function closeSearch() {
                searchModal.classList.remove('active');
                body.classList.remove('search-open');
            }

            searchClose?.addEventListener('click', closeSearch);

            // Close on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && searchModal.classList.contains('active')) {
                    closeSearch();
                }
            });

            // Close when clicking outside
            searchModal.addEventListener('click', function(e) {
                if (e.target === searchModal) {
                    closeSearch();
                }
            });
        }
    }

    // Newsletter Form
    function initNewsletterForm() {
        const newsletterForm = document.getElementById('newsletter-form');
        const messageDiv = document.getElementById('newsletter-message');

        if (newsletterForm) {
            newsletterForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(newsletterForm);
                const submitButton = newsletterForm.querySelector('button[type="submit"]');
                const originalText = submitButton.textContent;

                // Show loading state
                submitButton.textContent = 'Subscribing...';
                submitButton.disabled = true;

                // AJAX request
                $.ajax({
                    url: ooptech_ajax.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'newsletter_signup',
                        email: formData.get('email'),
                        nonce: ooptech_ajax.nonce
                    },
                    success: function(response) {
                        const result = JSON.parse(response);
                        
                        if (result.success) {
                            messageDiv.innerHTML = '<p class="success-message">' + result.message + '</p>';
                            newsletterForm.reset();
                        } else {
                            messageDiv.innerHTML = '<p class="error-message">' + result.message + '</p>';
                        }
                    },
                    error: function() {
                        messageDiv.innerHTML = '<p class="error-message">Something went wrong. Please try again.</p>';
                    },
                    complete: function() {
                        submitButton.textContent = originalText;
                        submitButton.disabled = false;
                        
                        // Clear message after 5 seconds
                        setTimeout(function() {
                            messageDiv.innerHTML = '';
                        }, 5000);
                    }
                });
            });
        }
    }

    // Smooth Scrolling
    function initSmoothScrolling() {
        // Smooth scroll for anchor links
        $('a[href^="#"]').on('click', function(e) {
            const target = $(this.getAttribute('href'));
            
            if (target.length) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 800);
            }
        });

        // Back to top button
        const backToTop = $('<button class="back-to-top" aria-label="Back to top">↑</button>');
        $('body').append(backToTop);

        $(window).scroll(function() {
            if ($(this).scrollTop() > 500) {
                backToTop.addClass('show');
            } else {
                backToTop.removeClass('show');
            }
        });

        backToTop.on('click', function() {
            $('html, body').animate({ scrollTop: 0 }, 600);
        });
    }

    // Reading Progress Indicator
    function initReadingProgress() {
        if ($('body').hasClass('single-post')) {
            const progressBar = $('<div class="reading-progress"><div class="reading-progress-bar"></div></div>');
            $('body').prepend(progressBar);

            $(window).scroll(function() {
                const scrollTop = $(window).scrollTop();
                const docHeight = $(document).height();
                const winHeight = $(window).height();
                const scrollPercent = (scrollTop / (docHeight - winHeight)) * 100;
                
                $('.reading-progress-bar').css('width', scrollPercent + '%');
            });
        }
    }

    // Lazy Loading for Images
    function initLazyLoading() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(function(img) {
                imageObserver.observe(img);
            });
        }
    }

    // Code Syntax Highlighting
    function initCodeHighlighting() {
        // Add copy button to code blocks
        $('pre').each(function() {
            const $pre = $(this);
            const $code = $pre.find('code');
            
            if ($code.length) {
                const copyButton = $('<button class="copy-code" aria-label="Copy code">Copy</button>');
                $pre.prepend(copyButton);
                
                copyButton.on('click', function() {
                    const text = $code.text();
                    
                    if (navigator.clipboard) {
                        navigator.clipboard.writeText(text).then(function() {
                            copyButton.text('Copied!');
                            setTimeout(function() {
                                copyButton.text('Copy');
                            }, 2000);
                        });
                    } else {
                        // Fallback for older browsers
                        const textArea = document.createElement('textarea');
                        textArea.value = text;
                        document.body.appendChild(textArea);
                        textArea.select();
                        document.execCommand('copy');
                        document.body.removeChild(textArea);
                        
                        copyButton.text('Copied!');
                        setTimeout(function() {
                            copyButton.text('Copy');
                        }, 2000);
                    }
                });
            }
        });
    }

    // Contact Form Enhancement
    function initContactForm() {
        const contactForm = document.querySelector('.contact-form');
        
        if (contactForm) {
            const inputs = contactForm.querySelectorAll('input, textarea');
            
            inputs.forEach(function(input) {
                // Add floating label effect
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    if (!this.value) {
                        this.parentElement.classList.remove('focused');
                    }
                });
                
                // Check if field has value on load
                if (input.value) {
                    input.parentElement.classList.add('focused');
                }
            });
        }
    }

    // Initialize contact form
    initContactForm();

    // Scroll animations
    function initScrollAnimations() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, observerOptions);

        // Observe elements for animation
        document.querySelectorAll('.post-card, .category-card, .card').forEach(function(el) {
            observer.observe(el);
        });
    }

    // Initialize scroll animations
    if (window.IntersectionObserver) {
        initScrollAnimations();
    }

    // Keyboard navigation for accessibility
    document.addEventListener('keydown', function(e) {
        // Skip links navigation
        if (e.key === 'Tab' && !e.shiftKey) {
            const skipLink = document.querySelector('.skip-link');
            if (document.activeElement === skipLink) {
                e.preventDefault();
                document.querySelector('#primary').focus();
            }
        }
    });

    // Print styles
    window.addEventListener('beforeprint', function() {
        document.body.classList.add('printing');
    });

    window.addEventListener('afterprint', function() {
        document.body.classList.remove('printing');
    });

})(jQuery);