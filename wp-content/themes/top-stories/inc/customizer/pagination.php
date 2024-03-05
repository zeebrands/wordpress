<?php
/**
 * Pagination Settings
 *
 * @package Top Stories
 */

$top_stories_default = top_stories_get_default_theme_options();

// Pagination Section.
$wp_customize->add_section( 'top_stories_pagination_section',
	array(
	'title'      => esc_html__( 'Pagination Settings', 'top-stories' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
	'panel'		 => 'theme_option_panel',
	)
);

// Pagination Layout Settings
$wp_customize->add_setting( 'top_stories_pagination_layout',
	array(
	'default'           => $top_stories_default['top_stories_pagination_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'top_stories_pagination_layout',
	array(
	'label'       => esc_html__( 'Pagination Method', 'top-stories' ),
	'section'     => 'top_stories_pagination_section',
	'type'        => 'select',
	'choices'     => array(
		'next-prev' => esc_html__('Next/Previous Method','top-stories'),
		'numeric' => esc_html__('Numeric Method','top-stories'),
		'load-more' => esc_html__('Ajax Load More Button','top-stories'),
		'auto-load' => esc_html__('Ajax Auto Load','top-stories'),
	),
	)
);


// Breadcrumb Section.
$wp_customize->add_section( 'top_stories_breadcrumb_with_title_block_section',
	array(
	'title'      => esc_html__( 'Breadcrumb Settings', 'top-stories' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
	'panel'		 => 'theme_option_panel',
	)
);


$wp_customize->add_setting('ed_breadcrumb',
    array(
        'default' => $top_stories_default['ed_breadcrumb'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'top_stories_sanitize_checkbox',
    )
);

$wp_customize->add_control('ed_breadcrumb',
    array(
        'label' => esc_html__('Enable Breadcrumb', 'top-stories'),
        'section' => 'top_stories_breadcrumb_with_title_block_section',
        'type' => 'checkbox',
    )
);
