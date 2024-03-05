<?php
/**
* Header Options.
*
* @package Top Stories
*/

$top_stories_default = top_stories_get_default_theme_options();
$top_stories_page_lists = top_stories_page_lists();
$top_stories_post_category_list = top_stories_post_category_list();

// Header Advertise Area Section.
$wp_customize->add_section( 'main_header_setting',
	array(
	'title'      => esc_html__( 'Header Settings', 'top-stories' ),
	'priority'   => 10,
	'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
	)
);

$wp_customize->add_setting('ed_header_ad',
    array(
        'default' => $top_stories_default['ed_header_ad'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'top_stories_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_ad',
    array(
        'label' => esc_html__('Enable Top Advertisement Area', 'top-stories'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('header_ad_image',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
);
$wp_customize->add_control( new WP_Customize_Image_Control(
    $wp_customize,
    'header_ad_image',
        array(
            'label'      => esc_html__( 'Top Header AD Image', 'top-stories' ),
            'section'    => 'main_header_setting',
            'active_callback' => 'top_stories_header_ad_ac',
        )
    )
);

$wp_customize->add_setting('ed_header_link',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control('ed_header_link',
    array(
        'label' => esc_html__('AD Image Link', 'top-stories'),
        'section' => 'main_header_setting',
        'type' => 'text',
        'active_callback' => 'top_stories_header_ad_ac',
    )
);


$wp_customize->add_setting('ed_header_new_entry_posts',
    array(
        'default' => $top_stories_default['ed_header_new_entry_posts'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'top_stories_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_new_entry_posts',
    array(
        'label' => esc_html__('Enable New Entry Posts', 'top-stories'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'ed_header_new_entry_posts_title',
    array(
    'default'           => $top_stories_default['ed_header_new_entry_posts_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'ed_header_new_entry_posts_title',
    array(
    'label'       => esc_html__( 'New Entry Section Title', 'top-stories' ),
    'section'     => 'main_header_setting',
    'type'        => 'text',
    )
);


$wp_customize->add_setting( 'top_stories_header_new_entry_cat',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'top_stories_sanitize_select',
    )
);
$wp_customize->add_control( 'top_stories_header_new_entry_cat',
    array(
    'label'       => esc_html__( 'New Entry Posts Category', 'top-stories' ),
    'section'     => 'main_header_setting',
    'type'        => 'select',
    'choices'     => $top_stories_post_category_list,
    )
);



// Archive Layout.
$wp_customize->add_setting(
    'top_stories_header_bg_size',
    array(
        'default'           => $top_stories_default['top_stories_header_bg_size'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control('top_stories_header_bg_size',
        array(
            'type'       => 'select',
            'section'       => 'header_image',
            'label'         => esc_html__( 'Header BG Size', 'top-stories' ),
            'choices'       => array(
                '1'  => esc_html__( 'Small', 'top-stories' ),
                '2'  => esc_html__( 'Medium', 'top-stories' ),
                '3'  => esc_html__( 'Large', 'top-stories' ),
            )
        )
);

$wp_customize->add_setting('ed_header_bg_fixed',
    array(
        'default' => $top_stories_default['ed_header_bg_fixed'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'top_stories_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_bg_fixed',
    array(
        'label' => esc_html__('Enable Fixed BG', 'top-stories'),
        'section' => 'header_image',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_header_bg_overlay',
    array(
        'default' => $top_stories_default['ed_header_bg_overlay'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'top_stories_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_bg_overlay',
    array(
        'label' => esc_html__('Enable BG Overlay', 'top-stories'),
        'section' => 'header_image',
        'type' => 'checkbox',
    )
);

// Trending News Section
$wp_customize->add_section( 'header_news_section',
    array(
    'title'      => esc_html__( 'Main Navigation Area', 'top-stories' ),
    'priority'   => 15,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
    )
);

$wp_customize->add_setting('ed_header_trending_news',
    array(
        'default' => $top_stories_default['ed_header_trending_news'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'top_stories_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_trending_news',
    array(
        'label' => esc_html__('Enable Trending News', 'top-stories'),
        'section' => 'header_news_section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'ed_header_trending_posts_title',
    array(
    'default'           => $top_stories_default['ed_header_trending_posts_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'ed_header_trending_posts_title',
    array(
    'label'       => esc_html__( 'Trending News Title', 'top-stories' ),
    'section'     => 'header_news_section',
    'type'        => 'text',
    )
);


$wp_customize->add_setting( 'top_stories_header_trending_cat',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'top_stories_sanitize_select',
    )
);
$wp_customize->add_control( 'top_stories_header_trending_cat',
    array(
    'label'       => esc_html__( 'Trending News Posts Category', 'top-stories' ),
    'section'     => 'header_news_section',
    'type'        => 'select',
    'choices'     => $top_stories_post_category_list,
    )
);