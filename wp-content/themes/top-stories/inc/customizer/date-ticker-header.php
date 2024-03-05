<?php
/**
* Header Options.
*
* @package Top Stories
*/

$top_stories_default = top_stories_get_default_theme_options();
$top_stories_post_category_list = top_stories_post_category_list();
$wp_customize->add_section( 'breaking_news_setting',
    array(
    'title'      => esc_html__( 'Ticker News Settings', 'top-stories' ),
    'priority'   => 13,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
    )
);


$wp_customize->add_setting('ed_header_ticker_posts',
    array(
        'default' => $top_stories_default['ed_header_ticker_posts'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'top_stories_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_ticker_posts',
    array(
        'label' => esc_html__('Enable Ticker Posts', 'top-stories'),
        'section' => 'breaking_news_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'ed_header_ticker_posts_title',
    array(
    'default'           => $top_stories_default['ed_header_ticker_posts_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'ed_header_ticker_posts_title',
    array(
    'label'       => esc_html__( 'Ticker Section Title', 'top-stories' ),
    'section'     => 'breaking_news_setting',
    'type'        => 'text',
    )
);


$wp_customize->add_setting( 'top_stories_header_ticker_cat',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'top_stories_sanitize_select',
    )
);
$wp_customize->add_control( 'top_stories_header_ticker_cat',
    array(
    'label'       => esc_html__( 'Ticker Posts Category', 'top-stories' ),
    'section'     => 'breaking_news_setting',
    'type'        => 'select',
    'choices'     => $top_stories_post_category_list,
    )
);

$wp_customize->add_setting('ed_ticker_slider_autoplay',
    array(
        'default' => $top_stories_default['ed_ticker_slider_autoplay'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'top_stories_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_ticker_slider_autoplay',
    array(
        'label' => esc_html__('Enable Ticker Posts Autoplay', 'top-stories'),
        'section' => 'breaking_news_setting',
        'type' => 'checkbox',
    )
);



$wp_customize->add_section( 'date_breaking_news_setting',
	array(
	'title'      => esc_html__( 'Header Extras Settings (date, clock)', 'top-stories' ),
	'priority'   => 13,
	'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
	)
);


$wp_customize->add_setting('ed_ticker_bar',
    array(
        'default' => $top_stories_default['ed_ticker_bar'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'top_stories_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_ticker_bar',
    array(
        'label' => esc_html__('Enable Ticker Bar', 'top-stories'),
        'section' => 'date_breaking_news_setting',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting('ed_ticker_bar_social_nav',
    array(
        'default' => $top_stories_default['ed_ticker_bar_social_nav'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'top_stories_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_ticker_bar_social_nav',
    array(
        'label' => esc_html__('Enable Social Nav', 'top-stories'),
        'section' => 'date_breaking_news_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_ticker_bar_date',
    array(
        'default' => $top_stories_default['ed_ticker_bar_date'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'top_stories_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_ticker_bar_date',
    array(
        'label' => esc_html__('Enable Current Date', 'top-stories'),
        'section' => 'date_breaking_news_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'ticker_date_format',
    array(
    'default'           => $top_stories_default['ticker_date_format'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'ticker_date_format',
    array(
    'label'       => esc_html__( 'Ticker Date Format', 'top-stories' ),
    'section'     => 'date_breaking_news_setting',
    'type'        => 'text',
    )
);
