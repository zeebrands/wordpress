<?php
/**
* Read Later Options.
*
* @package Top Stories
*/

$top_stories_default = top_stories_get_default_theme_options();

// Header Advertise Area Section.
$wp_customize->add_section( 'post_pp_section',
	array(
	'title'      => esc_html__( 'Read Later Post Settings', 'top-stories' ),
	'priority'   => 10,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

$wp_customize->add_setting('ed_post_read_later',
    array(
        'default' => $top_stories_default['ed_post_read_later'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'top_stories_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_read_later',
    array(
        'label' => esc_html__('Enable Posts Author', 'top-stories'),
        'section' => 'post_pp_section',
        'type' => 'checkbox',
    )
);