<?php
/**
 *
 * Front Page
 *
 * @package Top Stories
 */

get_header();


    $top_stories_default = top_stories_get_default_theme_options();
    $top_stories_default = top_stories_get_default_theme_options();
    $sidebar = esc_attr( get_theme_mod( 'global_sidebar_layout', $top_stories_default['global_sidebar_layout'] ) );
    

    if( is_single() || is_page() ){

        $top_stories_post_sidebar = esc_attr( get_post_meta( $post->ID, 'top_stories_post_sidebar_option', true ) );
        if( $top_stories_post_sidebar == 'global-sidebar' || empty( $top_stories_post_sidebar ) ){

            $sidebar = $sidebar;
        }else{
            $sidebar = $top_stories_post_sidebar;
        }

    }
    $twp_top_stories_home_sections_4 = get_theme_mod( 'twp_top_stories_home_sections_4', json_encode( $top_stories_default['twp_top_stories_home_sections_4'] ) );
    $repeat_times = 1;
    $paged_active = false;

    if ( !is_paged() ) {
        $paged_active = true;
    }

    $twp_top_stories_home_sections_4 = json_decode( $twp_top_stories_home_sections_4 );

    if( $twp_top_stories_home_sections_4 ){ ?>

        <?php
        foreach ( $twp_top_stories_home_sections_4 as $top_stories_home_section ) {

            $home_section_type = isset( $top_stories_home_section->home_section_type ) ? $top_stories_home_section->home_section_type : '';

            switch ($home_section_type) {

                case 'main-banner':

                    $ed_slider_blocks = isset( $top_stories_home_section->section_ed ) ? $top_stories_home_section->section_ed : '';
                    if ( $ed_slider_blocks == 'yes' && $paged_active ) {
                        top_stories_main_banner( $top_stories_home_section , $repeat_times);
                    }

                break;

                case 'latest-posts-blocks':

                    $ed_latest_posts_blocks = isset( $top_stories_home_section->section_ed ) ? $top_stories_home_section->section_ed : '';
                    if ( $ed_latest_posts_blocks == 'yes' ) {
                        top_stories_latest_blocks( $top_stories_home_section  , $repeat_times);
                    }

                break;

                case 'tiles-blocks':

                    $ed_tiles_block = isset( $top_stories_home_section->section_ed ) ? $top_stories_home_section->section_ed : '';
                    if ( $ed_tiles_block == 'yes' && $paged_active ) {
                        top_stories_tiles_block_section( $top_stories_home_section , $repeat_times);
                    }

                break;

                case 'banner-blocks-1':

                    $ed_banner_blocks_1 = isset( $top_stories_home_section->section_ed ) ? $top_stories_home_section->section_ed : '';
                    if ( $ed_banner_blocks_1 == 'yes' && $paged_active ) {
                        top_stories_banner_block_1_section( $top_stories_home_section , $repeat_times);
                    }

                break;

                case 'advertise-blocks':

                    $ed_advertise_blocks = isset( $top_stories_home_section->section_ed ) ? $top_stories_home_section->section_ed : '';
                    if ( $ed_advertise_blocks == 'yes' && $paged_active ) {
                        top_stories_advertise_block( $top_stories_home_section , $repeat_times);
                    }
                    
                break;

                case 'home-widget-area':

                    $ed_home_widget_area = isset( $top_stories_home_section->section_ed ) ? $top_stories_home_section->section_ed : '';
                    if ( $ed_home_widget_area == 'yes' && $paged_active ) {
                        top_stories_case_home_widget_area_block( $top_stories_home_section , $repeat_times);
                    }
                    
                break;

                case 'you-may-like-blocks':

                    $ed_you_may_like_area = isset( $top_stories_home_section->section_ed ) ? $top_stories_home_section->section_ed : '';
                    if ( $ed_you_may_like_area == 'yes' && $paged_active ) {
                        top_stories_you_may_like_block_section( $top_stories_home_section , $repeat_times);
                    }
                    
                break;

                default:

                break;

            }

        $repeat_times++;
        } 
        ?>

    <?php
    }

get_footer();
