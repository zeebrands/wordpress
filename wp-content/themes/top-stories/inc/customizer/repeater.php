<?php
/**
* Sections Repeater Options.
*
* @package Top Stories
*/

$top_stories_post_category_list = top_stories_post_category_list();
$top_stories_defaults = top_stories_get_default_theme_options();
$home_sections = array(
        
        'main-banner' => esc_html__('Main Banner Slider','top-stories'),
        'banner-blocks-1' => esc_html__('Slider & Tab Block','top-stories'),
        'latest-posts-blocks' => esc_html__('Latest Posts Block','top-stories'),
        'tiles-blocks' => esc_html__('Tiles Block','top-stories'),
        'advertise-blocks' => esc_html__('Advertise Block','top-stories'),
        'home-widget-area' => esc_html__('Widgets Area Block','top-stories'),
        'you-may-like-blocks' => esc_html__('You May Like Block','top-stories'),

    );

// Slider Section.
$wp_customize->add_section( 'home_sections_repeater',
	array(
	'title'      => esc_html__( 'Homepage Sections', 'top-stories' ),
	'priority'   => 150,
	'capability' => 'edit_theme_options',
	)
);


// Recommended Posts Enable Disable.
$wp_customize->add_setting( 'twp_top_stories_home_sections_4', array(
    'sanitize_callback' => 'top_stories_sanitize_repeater',
    'default' => json_encode( $top_stories_defaults['twp_top_stories_home_sections_4'] ),
    // 'transport'           => 'postMessage',
));

$wp_customize->add_control(  new Top_Stories_Repeater_Controler( $wp_customize, 'twp_top_stories_home_sections_4', 
    array(
        'section' => 'home_sections_repeater',
        'settings' => 'twp_top_stories_home_sections_4',
        'top_stories_box_label' => esc_html__('New Section','top-stories'),
        'top_stories_box_add_control' => esc_html__('Add New Section','top-stories'),
        'top_stories_box_add_button' => false,
    ),
        array(
            'section_ed' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Section', 'top-stories' ),
                'class'       => 'home-section-ed'
            ),
            'home_section_type' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Section Type', 'top-stories' ),
                'options'     => $home_sections,
                'class'       => 'home-section-type'
            ),
            'home_section_title' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Section Title', 'top-stories' ),
                'class'       => 'home-repeater-fields-hs tiles-blocks-fields you-may-like-blocks-fields'
            ),
            'section_slide_category' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Slider Post Category', 'top-stories' ),
                'options'     => $top_stories_post_category_list,
                'class'       => 'home-repeater-fields-hs'
            ),
            'section_category' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category', 'top-stories' ),
                'options'     => $top_stories_post_category_list,
                'class'       => 'home-repeater-fields-hs tiles-blocks-fields you-may-like-blocks-fields'
            ),
             'tiles_post_per_page' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Posts Per Page', 'top-stories' ),
                'options'     => array( 
                    '5' => 5,
                    '10' => 10,
                ),
                'class'       => 'home-repeater-fields-hs tiles-blocks-fields'
            ),
             'home_section_column_1' => array(
                  'type'        => 'seperator',
                  'seperator_text'       => esc_html__( 'Column 1', 'top-stories' ),
                  'class'       => 'home-repeater-fields-hs main-banner-fields'
              ),
              'home_section_title_4' => array(
                 'type'        => 'text',
                 'label'       => esc_html__( 'Block Title', 'top-stories' ),
                 'class'       => 'home-repeater-fields-hs main-banner-fields'
             ),

              'section_post_cat_1' => array(
                  'type'        => 'select',
                  'label'       => esc_html__( 'Select Category', 'top-stories' ),
                  'options'     => $top_stories_post_category_list,
                  'class'       => 'home-repeater-fields-hs main-banner-fields'
              ),
              'home_section_column_2' => array(
                   'type'        => 'seperator',
                   'seperator_text'       => esc_html__( 'Column 2', 'top-stories' ),
                   'class'       => 'home-repeater-fields-hs main-banner-fields'
               ),
             'home_section_title_1' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Slider Area Title', 'top-stories' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields main-banner-fields'
            ),
            'section_post_slide_cat' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Slider Post Category', 'top-stories' ),
                'options'     => $top_stories_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields main-banner-fields'
            ),


            'advertise_image' => array(
                'type'        => 'upload',
                'label'       => esc_html__( 'Advertise Image', 'top-stories' ),
                'description' => esc_html__( 'Recommended Image Size is 970x250 PX.', 'top-stories' ),
                'class'       => 'home-repeater-fields-hs advertise-blocks-fields'
            ),
            'advertise_link' => array(
                'type'        => 'link',
                'label'       => esc_html__( 'Advertise Image Link', 'top-stories' ),
                'class'       => 'home-repeater-fields-hs advertise-blocks-fields'
            ),
            'ed_arrows_carousel' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Arrows', 'top-stories' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields main-banner-fields'
            ),
            'ed_dots_carousel' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Dot', 'top-stories' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields main-banner-fields'
            ),

            'section_post_grid_post_cat' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Grid Post Category', 'top-stories' ),
                'options'     => $top_stories_post_category_list,
                'class'       => 'home-repeater-fields-hs main-banner-fields'
            ),
            
            'section_post_list_post_cat' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'List Post Category', 'top-stories' ),
                'options'     => $top_stories_post_category_list,
                'class'       => 'home-repeater-fields-hs main-banner-fields'
            ),

            'ed_autoplay_carousel' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Autoplay', 'top-stories' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields'
            ),
            'home_section_column_3' => array(
                 'type'        => 'seperator',
                 'seperator_text'       => esc_html__( 'Column 3', 'top-stories' ),
                 'class'       => 'home-repeater-fields-hs main-banner-fields'
             ),
            'home_section_title_2' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Tab Area Title', 'top-stories' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields'
            ),
            'home_section_title_3' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Block Title', 'top-stories' ),
                'class'       => 'home-repeater-fields-hs main-banner-fields'
            ),
            'ed_tab' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Tab', 'top-stories' ),
                'class'       => 'home-repeater-fields-hs ed-tabs-ac banner-blocks-1-fields'
            ),
            'cat_title_1' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Section Title One', 'top-stories' ),
                'class'       => 'home-repeater-fields-hs '
            ),
            'section_category_1' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category One', 'top-stories' ),
                'options'     => $top_stories_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields'
            ),
            'cat_title_2' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Section Title Two', 'top-stories' ),
                'class'       => 'home-repeater-fields-hs '
            ),
            'section_category_2' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category Two', 'top-stories' ),
                'options'     => $top_stories_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-block-1-tab-ac banner-blocks-1-fields'
            ),
            'cat_title_3' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Section Title Three', 'top-stories' ),
                'class'       => 'home-repeater-fields-hs '
            ),
            'section_category_3' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category Three', 'top-stories' ),
                'options'     => $top_stories_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-block-1-tab-ac banner-blocks-1-fields'
            ),
            'section_category_4' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category Four', 'top-stories' ),
                'options'     => $top_stories_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-block-1-tab-ac banner-blocks-1-fields'
            ),
            'section_vertical_list_category' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Select Category', 'top-stories' ),
                'options'     => $top_stories_post_category_list,
                'class'       => 'home-repeater-fields-hs main-banner-fields'
            ),
            'ed_flip_column' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Flip Column Right to Left', 'top-stories' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields'
            ),
            'background_color' => array(
                'type'        => 'colorpicker',
                'label'       => esc_html__( 'Background Color', 'top-stories' ),
                'class'       => 'home-repeater-fields-hs main-banner-fields banner-blocks-1-fields latest-posts-blocks-fields tiles-blocks-fields advertise-blocks-fields you-may-like-blocks-fields'
            ),
            'section_text_color' => array(
                'type'        => 'colorpicker',
                'label'       => esc_html__( 'Text Color', 'top-stories' ),
                'class'       => 'home-repeater-fields-hs main-banner-fields banner-blocks-1-fields latest-posts-blocks-fields tiles-blocks-fields advertise-blocks-fields you-may-like-blocks-fields'
            ),
            'background_image' => array(
                'type'        => 'upload',
                'label'       => esc_html__( 'Background Image', 'top-stories' ),
                'class'       => 'home-repeater-fields-hs main-banner-fields banner-blocks-1-fields tiles-blocks-fields you-may-like-blocks-fields'
            ),
            'bg_image_size' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Background Image Size', 'top-stories' ),
                'options'     => array( 
                    'auto' => esc_html('Original','top-stories'),
                    'contain' => esc_html('Fit to Screen','top-stories'),
                    'cover' => esc_html('Fill Screen','top-stories'),
                ),
                'class'       => 'home-repeater-fields-hs main-banner-fields banner-blocks-1-fields tiles-blocks-fields you-may-like-blocks-fields'
            ),
            'background_image_repeat' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Repeat Background Image', 'top-stories' ),
                'class'       => 'home-repeater-fields-hs main-banner-fields banner-blocks-1-fields tiles-blocks-fields'
            ),
            'background_image_scroll' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Scroll with Page', 'top-stories' ),
                'class'       => 'home-repeater-fields-hs main-banner-fields banner-blocks-1-fields tiles-blocks-fields you-may-like-blocks-fields'
            ),
    )
));

// Info.
$wp_customize->add_setting(
    'top_stories_notice_info',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new Top_Stories_Info_Notice_Control( 
        $wp_customize,
        'top_stories_notice_info',
        array(
            'settings' => 'top_stories_notice_info',
            'section'       => 'home_sections_repeater',
            'label'         => esc_html__( 'Info', 'top-stories' ),
        )
    )
);

$wp_customize->add_setting(
    'top_stories_premium_notice',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new Top_Stories_Premium_Notice_Control( 
        $wp_customize,
        'top_stories_premium_notice',
        array(
            'label'      => esc_html__( 'Home Page Blocks', 'top-stories' ),
            'settings' => 'top_stories_premium_notice',
            'section'       => 'home_sections_repeater',
        )
    )
);