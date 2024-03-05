<?php
/**
 * Top Stories Dynamic Styles
 *
 * @package Top Stories
 */

function top_stories_dynamic_css()
{

    $top_stories_default = top_stories_get_default_theme_options();
    $twp_top_stories_home_sections_4 = get_theme_mod('twp_top_stories_home_sections_4', json_encode($top_stories_default['twp_top_stories_home_sections_4']));
    $twp_top_stories_home_sections_4 = json_decode($twp_top_stories_home_sections_4);


    echo "<style type='text/css' media='all'>"; ?>

    <?php

    $repeat_times = 1;

    foreach ($twp_top_stories_home_sections_4 as $top_stories_home_section) {

        $section_text_color = esc_url(isset($top_stories_home_section->section_text_color) ? $top_stories_home_section->section_text_color : '');

        if ($section_text_color) { ?>

            #theme-block-<?php echo $repeat_times; ?> {
            color: <?php echo esc_url($section_text_color); ?>;
            }

            #theme-block-<?php echo $repeat_times; ?>.theme-main-banner .border-md-highlight .block-title{
            color: <?php echo esc_url($section_text_color); ?>;
            }

            #theme-block-<?php echo $repeat_times; ?> .news-article-list{
            border-color: <?php echo top_stories_hex_2_rgba($section_text_color, 0.25); ?>;
            }

            <?php
        }
        $section_background_color = esc_url(isset($top_stories_home_section->background_color) ? $top_stories_home_section->background_color : '');

        if ($section_background_color) { ?>

            #theme-block-<?php echo $repeat_times; ?> {
            background-color: <?php echo esc_url($section_background_color); ?>;
            margin-bottom:0;
            }

            <?php
        }

        $background_image = esc_url(isset($top_stories_home_section->background_image) ? $top_stories_home_section->background_image : '');

        if ($background_image) {

            $bg_image_size = isset($top_stories_home_section->bg_image_size) ? $top_stories_home_section->bg_image_size : 'auto';
            $background_image_repeat = isset($top_stories_home_section->background_image_repeat) ? $top_stories_home_section->background_image_repeat : 'yes';
            $background_image_scroll = isset($top_stories_home_section->background_image_scroll) ? $top_stories_home_section->background_image_scroll : 'yes';

            if ($background_image_repeat == 'yes' || $background_image_repeat == '') {
                $background_image_repeat = 'repeat';
            } else {
                $background_image_repeat = 'no-repeat';
            }

            if ($background_image_scroll == 'yes' || $background_image_scroll == '') {
                $background_image_scroll = 'scroll';
            } else {
                $background_image_scroll = 'fixed';
            } ?>

            #theme-block-<?php echo $repeat_times; ?> {
            background-image: url(<?php echo esc_url($background_image); ?> );
            background-size: <?php echo esc_attr($bg_image_size); ?>;
            background-repeat: <?php echo esc_attr($background_image_repeat); ?>;
            background-attachment: <?php echo esc_attr($background_image_scroll); ?>;
            }

            <?php
        }

        $repeat_times++;
    } ?>

    <?php echo "</style>";
}

add_action('wp_head', 'top_stories_dynamic_css', 100);

/**
 * Sanitizing Hex color function.
 */
function top_stories_sanitize_hex_color($color)
{

    if ('' === $color)
        return '';
    if (preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color))
        return $color;

}