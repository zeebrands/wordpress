<?php
/**
* Layouts Settings.
*
* @package Top Stories
*/

$top_stories_default = top_stories_get_default_theme_options();

// Layout Section.
$wp_customize->add_section( 'layout_setting',
	array(
	'title'      => esc_html__( 'Archive Settings', 'top-stories' ),
	'priority'   => 60,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);


$wp_customize->add_setting( 'global_sidebar_layout',
	array(
	'default'           => $top_stories_default['global_sidebar_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'top_stories_sanitize_sidebar_option',
	)
);
$wp_customize->add_control( 'global_sidebar_layout',
	array(
	'label'       => esc_html__( 'Global Sidebar Layout', 'top-stories' ),
	'section'     => 'layout_setting',
	'type'        => 'select',
	'choices'     => array(
		'right-sidebar' => esc_html__( 'Right Sidebar', 'top-stories' ),
		'left-sidebar'  => esc_html__( 'Left Sidebar', 'top-stories' ),
		'no-sidebar'    => esc_html__( 'No Sidebar', 'top-stories' ),
	    ),
	)
);

// Archive Layout.
$wp_customize->add_setting(
    'top_stories_archive_layout',
    array(
        'default' 			=> $top_stories_default['top_stories_archive_layout'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'top_stories_sanitize_archive_layout'
    )
);
$wp_customize->add_control(
    new Top_Stories_Custom_Radio_Image_Control(
        $wp_customize,
        'top_stories_archive_layout',
        array(
            'settings'      => 'top_stories_archive_layout',
            'section'       => 'layout_setting',
            'label'         => esc_html__( 'Archive Layout', 'top-stories' ),
            'choices'       => array(
            	'default'  => get_template_directory_uri() . '/assets/images/Layout-style-1.png',
                'full'  => get_template_directory_uri() . '/assets/images/Layout-style-2.png',
                'grid'  => get_template_directory_uri() . '/assets/images/Layout-style-3.png',
            )
        )
    )
);


$wp_customize->add_setting('ed_image_content_inverse',
    array(
        'default' => $top_stories_default['ed_image_content_inverse'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'top_stories_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_image_content_inverse',
    array(
        'label' => esc_html__('Inverse Image with Content', 'top-stories'),
        'section' => 'layout_setting',
        'type' => 'checkbox',
        'active_callback' => 'top_stories_header_archive_layout_ac',
    )
);

