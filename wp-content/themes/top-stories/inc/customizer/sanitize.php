<?php
/**
* Custom Functions.
*
* @package Top Stories
*/


if( !function_exists( 'top_stories_sanitize_sidebar_option' ) ) :

    // Sidebar Option Sanitize.
    function top_stories_sanitize_sidebar_option( $top_stories_input ){

        $top_stories_metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $top_stories_input,$top_stories_metabox_options ) ){

            return $top_stories_input;

        }

        return;

    }

endif;

if( !function_exists( 'top_stories_sanitize_single_pagination_layout' ) ) :

    // Sidebar Option Sanitize.
    function top_stories_sanitize_single_pagination_layout( $top_stories_input ){

        $top_stories_single_pagination = array( 'no-navigation','norma-navigation','ajax-next-post-load' );
        if( in_array( $top_stories_input,$top_stories_single_pagination ) ){

            return $top_stories_input;

        }

        return;

    }

endif;

if( !function_exists( 'top_stories_sanitize_archive_layout' ) ) :

    // Sidebar Option Sanitize.
    function top_stories_sanitize_archive_layout( $top_stories_input ){

        $top_stories_archive_option = array( 'default','full','grid' );
        if( in_array( $top_stories_input,$top_stories_archive_option ) ){

            return $top_stories_input;

        }

        return;

    }

endif;

if( !function_exists( 'top_stories_sanitize_single_post_layout' ) ) :

    // Single Layout Option Sanitize.
    function top_stories_sanitize_single_post_layout( $top_stories_input ){

        $top_stories_single_layout = array( 'layout-1','layout-2' );
        if( in_array( $top_stories_input,$top_stories_single_layout ) ){

            return $top_stories_input;

        }

        return;

    }

endif;

if ( ! function_exists( 'top_stories_sanitize_checkbox' ) ) :

	/**
	 * Sanitize checkbox.
	 */
	function top_stories_sanitize_checkbox( $top_stories_checked ) {

		return ( ( isset( $top_stories_checked ) && true === $top_stories_checked ) ? true : false );

	}

endif;


if ( ! function_exists( 'top_stories_sanitize_select' ) ) :

    /**
     * Sanitize select.
     */
    function top_stories_sanitize_select( $top_stories_input, $top_stories_setting ) {

        // Ensure input is a slug.
        $top_stories_input = sanitize_text_field( $top_stories_input );

        // Get list of choices from the control associated with the setting.
        $choices = $top_stories_setting->manager->get_control( $top_stories_setting->id )->choices;

        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $top_stories_input, $choices ) ? $top_stories_input : $top_stories_setting->default );

    }

endif;

if ( ! function_exists( 'top_stories_sanitize_repeater' ) ) :
    
    /**
    * Sanitise Repeater Field
    */
    function top_stories_sanitize_repeater($input){
        $input_decoded = json_decode( $input, true );
        
        if(!empty($input_decoded)) {

            foreach ($input_decoded as $boxes => $box ){

                foreach ($box as $key => $value){

                    if( $key == 'section_ed' 
                        || $key == 'ed_tab' 
                        || $key == 'ed_arrows_carousel' 
                        || $key == 'ed_dots_carousel' 
                        || $key == 'ed_autoplay_carousel' 
                        || $key == 'ed_flip_column' 
                        || $key == 'ed_ribbon_bg'
                    ){

                        $input_decoded[$boxes][$key] = top_stories_sanitize_repeater_ed( $value );

                    }elseif( $key == 'home_section_type' ){

                        $input_decoded[$boxes][$key] = top_stories_sanitize_home_sections( $value );

                    }elseif( $key == 'ribbon_bg_color_schema' ){

                        $input_decoded[$boxes][$key] = top_stories_sanitize_ribbon_bg( $value );

                    }elseif( $key == 'category_color' ){

                        $input_decoded[$boxes][$key] = sanitize_hex_color( $value );

                    }elseif( $key == 'tiles_post_per_page' ){

                        $input_decoded[$boxes][$key] =  absint( $value );

                    }elseif( $key == 'advertise_image' || $key == 'advertise_link' ){

                         $input_decoded[$boxes][$key] = esc_url_raw( $value );

                    }elseif($key == 'section_category' || 
                            $key == 'section_post_slide_cat' || 
                            $key == 'section_post_cat_1' || 
                            $key == 'section_category_1' || 
                            $key == 'section_category_2' || 
                            $key == 'section_category_3' || 
                            $key == 'section_category_4' || 
                            $key == 'category'
                        ){

                        $input_decoded[$boxes][$key] =  top_stories_sanitize_category( $value );

                    }else{

                        $input_decoded[$boxes][$key] = sanitize_text_field( $value );

                    }
                    
                }

            }
           
            return json_encode($input_decoded);

        }

        return $input;
    }
endif;

/** Sanitize Enable Disable Checkbox **/
function top_stories_sanitize_repeater_ed( $input ) {

    $valid_keys = array('yes','no');
    if ( in_array( $input , $valid_keys ) ) {
        return $input;
    }
    return '';

}

function top_stories_sanitize_home_sections( $input ) {

    $home_sections = array(

        'main-banner' => esc_html__('Main Banner Slider','top-stories'),
        'banner-blocks-1' => esc_html__('Slider & Tab Block','top-stories'),
        'latest-posts-blocks' => esc_html__('Latest Posts Block','top-stories'),
        'slider-blocks' => esc_html__('Slider Block','top-stories'),
        'tiles-blocks' => esc_html__('Tiles Block','top-stories'),
        'advertise-blocks' => esc_html__('Advertise Block','top-stories'),
        'home-widget-area' => esc_html__('Widgets Area Block','top-stories'),
        'you-may-like-blocks' => esc_html__('You May Like Block','top-stories'),

    );
    if ( array_key_exists( $input , $home_sections ) ) {
        return $input;
    }
    return '';

}

/** Sanitize Category **/
function top_stories_sanitize_category( $input ) {

   $top_stories_post_category_list = top_stories_post_category_list();
    if ( array_key_exists( $input , $top_stories_post_category_list ) ) {
        return $input;
    }
    return '';

}

function top_stories_sanitize_ribbon_bg( $input ) {

    $ribbon_bg = array( 
                    '1' =>  array(
                                    'title' =>  esc_html__( 'Blue', 'top-stories' ),
                                    'color' =>  '#3061ff',
                                ),
                    '2' =>  array(
                                    'title' =>  esc_html__( 'Orange', 'top-stories' ),
                                    'color' =>  '#fa9000',
                                ),
                    '3' =>  array(
                                    'title' =>  esc_html__( 'Royal Blue', 'top-stories' ),
                                    'color' =>  '#00167a',
                                ),
                    '4' =>  array(
                                    'title' =>  esc_html__( 'Pink', 'top-stories' ),
                                    'color' =>  '#ff2d55',
                                ),
                );

    if ( array_key_exists( $input , $ribbon_bg ) ) {
        return $input;
    }
    return '';

}