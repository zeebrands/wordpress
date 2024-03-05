<?php
/**
 * Top Stories Customizer Active Callback Functions
 *
 * @package Top Stories
 */

function top_stories_header_archive_layout_ac( $control ){

    $top_stories_archive_layout = $control->manager->get_setting( 'top_stories_archive_layout' )->value();
    if( $top_stories_archive_layout == 'default' ){

        return true;
        
    }
    
    return false;
}

function top_stories_overlay_layout_ac( $control ){

    $top_stories_single_post_layout = $control->manager->get_setting( 'top_stories_single_post_layout' )->value();
    if( $top_stories_single_post_layout == 'layout-2' ){

        return true;
        
    }
    
    return false;
}

function top_stories_header_ad_ac( $control ){

    $ed_header_ad = $control->manager->get_setting( 'ed_header_ad' )->value();
    if( $ed_header_ad ){

        return true;
        
    }
    
    return false;
}