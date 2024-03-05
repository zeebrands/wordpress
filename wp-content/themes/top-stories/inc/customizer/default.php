<?php
/**
 * Default Values.
 *
 * @package Top Stories
 */

if (!function_exists('top_stories_get_default_theme_options')) :

    /**
     * Get default theme options
     *
     * @return array Default theme options.
     * @since 1.0.0
     *
     */
    function top_stories_get_default_theme_options(){

        $top_stories_defaults = array();

        $top_stories_defaults['twp_top_stories_home_sections_4'] = array(

            array(
                'home_section_type' => 'main-banner',
                'section_ed' => 'yes',
                'home_section_title_1' => esc_html__('Column Title Two','top-stories'),
                'home_section_title_4' => esc_html__('Column Title One','top-stories'),
                'section_post_cat_1' => '',
                'ed_arrows_carousel' => 'yes',
                'ed_dots_carousel' => 'no',
                'home_section_title_3' => esc_html__('Column Title Three','top-stories'),
                'section_category_3' => '',
                'background_color' => '#f2f8f8',
                'section_text_color' => '#222'
            ),
            array(
                'home_section_type' => 'tiles-blocks',
                'section_ed' => 'no',
                'section_category' => '',
                'tiles_post_per_page' => 5,
                'background_color' => '#fff',
                'section_text_color' => '#222'
            ),
            array(
                'home_section_type' => 'banner-blocks-1',
                'section_ed' => 'no',
                'section_category_1' => '',
                'section_category_2' => '',
                'ed_flip_column' => 'no',
                'ed_tab' => 'no',
                'ed_dots_carousel' => 'no',
                'ed_autoplay_carousel' => 'yes',
                'home_section_title_1' => esc_html__('Block Title One','top-stories'),
                'home_section_title_2' => esc_html__('Block Title Tab','top-stories'),
                'background_color' => '#728146',
                'section_text_color' => '#fff'
            ),
            array(
                'home_section_type' => 'latest-posts-blocks',
                'section_ed' => 'yes',
                'background_color' => '#fff',
                'section_text_color' => '#222'
            ),
            array(
                'home_section_type' => 'advertise-blocks',
                'section_ed' => 'no',
                'advertise_image' => '',
                'advertise_link' => '',
                'background_color' => '#fff',
                'section_text_color' => '#222'
            ),
            array(
                'home_section_type' => 'home-widget-area',
                'section_ed' => 'yes',
            ),
            array(
                'home_section_type' => 'you-may-like-blocks',
                'section_ed' => 'yes',
                'home_section_title' => '',
                'section_category' => '',
                'background_color' => '#fff',
                'section_text_color' => '#222'
            ),
        );

        // header section
        $top_stories_defaults['ed_header_new_entry_posts'] = 1;
        $top_stories_defaults['ed_header_new_entry_posts_title'] = esc_html__('New Entry : From Editor', 'top-stories');
        $top_stories_defaults['top_stories_header_new_entry_cat'] = '';

        // Options.
        $top_stories_defaults['global_sidebar_layout'] = 'left-sidebar';
        $top_stories_defaults['top_stories_archive_layout'] = 'default';
        $top_stories_defaults['top_stories_pagination_layout'] = 'numeric';
        $top_stories_defaults['ed_breadcrumb'] = 1;
        $top_stories_defaults['footer_column_layout'] = 3;
        $top_stories_defaults['footer_copyright_text'] = esc_html__('All rights reserved.', 'top-stories');
        $top_stories_defaults['ed_ticker_slider_autoplay'] = 1;
        $top_stories_defaults['ed_header_trending_news'] = 1;
        $top_stories_defaults['ed_header_trending_posts_title'] = esc_html__('Trending News', 'top-stories');
        $top_stories_defaults['ed_header_ad'] = 0;
        $top_stories_defaults['ed_header_ticker_posts'] = 1;
        $top_stories_defaults['ticker_date_format'] = 'l, F jS, Y';
        $top_stories_defaults['ed_header_ticker_posts_title'] = esc_html__('Breaking News', 'top-stories');
        $top_stories_defaults['ed_image_content_inverse'] = 0;
        $top_stories_defaults['ed_related_post'] = 1;
        $top_stories_defaults['related_post_title'] = esc_html__('More Stories', 'top-stories');
        $top_stories_defaults['twp_navigation_type'] = 'norma-navigation';
        $top_stories_defaults['top_stories_single_post_layout'] = 'layout-1';
        $top_stories_defaults['ed_post_thumbnail'] = 0;
        $top_stories_defaults['ed_post_date'] = 1;
        $top_stories_defaults['ed_post_category'] = 1;
        $top_stories_defaults['ed_header_overlay'] = 0;
        $top_stories_defaults['ed_floating_next_previous_nav'] = 1;       
        $top_stories_defaults['top_stories_header_bg_size'] = 1;
        $top_stories_defaults['ed_preloader'] = 1;
        $top_stories_defaults['ed_header_bg_fixed'] = 0;
        $top_stories_defaults['ed_header_bg_overlay'] = 0;
        $top_stories_defaults['post_date_format'] = 'default';
        $top_stories_defaults['ed_fullwidth_layout'] = 'default';
        $top_stories_defaults['ed_post_views'] = 0;
        $top_stories_defaults['ed_scroll_top_button'] = 1;

        $top_stories_defaults['ed_ticker_bar']                  = 1;
        $top_stories_defaults['ed_ticker_bar_date']             = 1;
        $top_stories_defaults['ed_tags_wide_layout']             = 1;
        $top_stories_defaults['ed_post_tags']                   = 1;
        $top_stories_defaults['ed_post_read_later']             = 1;
        $top_stories_defaults['ed_ticker_bar_social_nav']             = 1;

        // Pass through filter.
        $top_stories_defaults = apply_filters('top_stories_filter_default_theme_options', $top_stories_defaults);

        return $top_stories_defaults;

    }

endif;
