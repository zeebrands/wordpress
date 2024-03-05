<?php

/**
 * Top Stories About Page
 * @package Top Stories
 *
 */

if (!class_exists('Top_Stories_About_page')):

    class Top_Stories_About_page
    {

        function __construct()
        {

            add_action('admin_menu', array($this, 'top_stories_backend_menu'), 999);

        }

        // Add Backend Menu
        function top_stories_backend_menu()
        {

            add_theme_page(esc_html__('Top Stories', 'top-stories'), esc_html__('Top Stories', 'top-stories'), 'activate_plugins', 'top-stories-about', array($this, 'top_stories_main_page'), 1);

        }

        // Settings Form
        function top_stories_main_page()
        {

            require get_template_directory() . '/classes/about-render.php';

        }

    }

    new Top_Stories_About_page();

endif;