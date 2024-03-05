<?php
/**
 * Widget FUnctions.
 *
 * @package Top Stories
 */
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function top_stories_widgets_init(){

    $top_stories_default = top_stories_get_default_theme_options();

    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'top-stories'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'top-stories'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));

    $twp_top_stories_home_sections_4 = get_theme_mod('twp_top_stories_home_sections_4', json_encode($top_stories_default['twp_top_stories_home_sections_4']));
    $twp_top_stories_home_sections_4 = json_decode($twp_top_stories_home_sections_4);

    foreach( $twp_top_stories_home_sections_4 as $top_stories_home_section ){

        $home_section_type = isset( $top_stories_home_section->home_section_type ) ? $top_stories_home_section->home_section_type : '';

        switch( $home_section_type ){

            case 'home-widget-area':

                $ed_home_widget_area = isset( $top_stories_home_section->section_ed ) ? $top_stories_home_section->section_ed : '';

                if( $ed_home_widget_area == 'yes' ){

                    register_sidebar(array(
                        'name' => esc_html__('Front Page 3 Column - Col 1', 'top-stories'),
                        'id' => 'front-page-3-column-col-1',
                        'description' => esc_html__('Add widgets here.', 'top-stories'),
                        'before_widget' => '<div id="%1$s" class="widget %2$s">',
                        'after_widget' => '</div>',
                        'before_title' => '<h2 class="widget-title"><span>',
                        'after_title' => '</span></h2>',
                    ));

                    register_sidebar(array(
                        'name' => esc_html__('Front Page 3 Column - Col 2', 'top-stories'),
                        'id' => 'front-page-3-column-col-2',
                        'description' => esc_html__('Add widgets here.', 'top-stories'),
                        'before_widget' => '<div id="%1$s" class="widget %2$s">',
                        'after_widget' => '</div>',
                        'before_title' => '<h2 class="widget-title"><span>',
                        'after_title' => '</span></h2>',
                    ));

                    register_sidebar(array(
                        'name' => esc_html__('Front Page 3 Column - Col 3', 'top-stories'),
                        'id' => 'front-page-3-column-col-3',
                        'description' => esc_html__('Add widgets here.', 'top-stories'),
                        'before_widget' => '<div id="%1$s" class="widget %2$s">',
                        'after_widget' => '</div>',
                        'before_title' => '<h2 class="widget-title"><span>',
                        'after_title' => '</span></h2>',
                    ));


                    register_sidebar(array(
                        'name' => esc_html__('Front Page 2 Column - Col 1', 'top-stories'),
                        'id' => 'front-page-2-column-col-1',
                        'description' => esc_html__('Add widgets here.', 'top-stories'),
                        'before_widget' => '<div id="%1$s" class="widget %2$s">',
                        'after_widget' => '</div>',
                        'before_title' => '<h2 class="widget-title"><span>',
                        'after_title' => '</span></h2>',
                    ));

                    register_sidebar(array(
                        'name' => esc_html__('Front Page 2 Column - Col 2', 'top-stories'),
                        'id' => 'front-page-2-column-col-2',
                        'description' => esc_html__('Add widgets here.', 'top-stories'),
                        'before_widget' => '<div id="%1$s" class="widget %2$s">',
                        'after_widget' => '</div>',
                        'before_title' => '<h2 class="widget-title"><span>',
                        'after_title' => '</span></h2>',
                    ));

                }

                break;

            default:

                break;

        }

    }

    $top_stories_default = top_stories_get_default_theme_options();
    $footer_column_layout = absint(get_theme_mod('footer_column_layout', $top_stories_default['footer_column_layout']));

    for( $i = 0; $i < $footer_column_layout; $i++ ){

        if ($i == 0) {
            $count = esc_html__('One', 'top-stories');
        }
        if ($i == 1) {
            $count = esc_html__('Two', 'top-stories');
        }
        if ($i == 2) {
            $count = esc_html__('Three', 'top-stories');
        }
        if ($i == 3) {
            $count = esc_html__('Four', 'top-stories');
        }

        register_sidebar(array(
            'name' => esc_html__('Footer Widget ', 'top-stories') . $count,
            'id' => 'top-stories-footer-widget-' . $i,
            'description' => esc_html__('Add widgets here.', 'top-stories'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
        ));

    }

}

add_action('widgets_init', 'top_stories_widgets_init');
require get_template_directory() . '/inc/widgets/widget-base.php';
require get_template_directory() . '/inc/widgets/author.php';
require get_template_directory() . '/inc/widgets/widget-style-1.php';
require get_template_directory() . '/inc/widgets/widget-style-2.php';
require get_template_directory() . '/inc/widgets/social-link.php';
require get_template_directory() . '/inc/widgets/featured-category-widget.php';