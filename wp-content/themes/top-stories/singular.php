<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Top Stories
 * @since 1.0.0
 */
get_header();

$current_id = '';
if( have_posts() ):
    while (have_posts()) :
    the_post();
        $current_id  = get_the_ID();
    endwhile;
    wp_reset_postdata();
endif;
    
    $top_stories_default = top_stories_get_default_theme_options();
    $sidebar = get_theme_mod( 'global_sidebar_layout', $top_stories_default['global_sidebar_layout'] );
    $top_stories_post_sidebar = esc_attr( get_post_meta( $current_id, 'top_stories_post_sidebar_option', true ) );
    $twp_navigation_type = esc_attr( get_post_meta( $current_id, 'twp_disable_ajax_load_next_post', true ) );
    $top_stories_header_trending_page = get_theme_mod( 'top_stories_header_trending_page' );
    $top_stories_header_popular_page = get_theme_mod( 'top_stories_header_popular_page' );
    $top_stories_archive_layout = esc_attr( get_theme_mod( 'top_stories_archive_layout', $top_stories_default['top_stories_archive_layout'] ) );
    $article_wrap_class = '';
    $single_layout_class = ' single-layout-default';

    if( $twp_navigation_type == '' || $twp_navigation_type == 'global-layout' ){
        $twp_navigation_type = get_theme_mod('twp_navigation_type', $top_stories_default['twp_navigation_type']);
    }

    if( $top_stories_post_sidebar == 'global-sidebar' || empty( $top_stories_post_sidebar ) ){
        $sidebar = $sidebar;
    }else{
        $sidebar = $top_stories_post_sidebar;
    }
    $top_stories_post_layout = esc_attr( get_post_meta( $current_id, 'top_stories_post_layout', true ) );
    if( $top_stories_post_layout == '' || $top_stories_post_layout == 'global-layout' ){
        
        $top_stories_post_layout = get_theme_mod( 'top_stories_single_post_layout',$top_stories_default['top_stories_archive_layout'] );
    }
    if( $top_stories_post_layout == 'layout-2' ){
        $single_layout_class = ' single-layout-banner';
    }
    if( $top_stories_header_trending_page == $current_id || $top_stories_header_popular_page == $current_id ){
        $article_wrap_class = 'archive-layout-' . esc_attr($top_stories_archive_layout);
        $single_layout_class = '';
    }
    $top_stories_header_trending_page = get_theme_mod( 'top_stories_header_trending_page' );
    $top_stories_header_popular_page = get_theme_mod( 'top_stories_header_popular_page' );
    if( $top_stories_header_trending_page == get_the_ID() || $top_stories_header_popular_page == get_the_ID() ){

        $breadcrumb = true;

    }
    $top_stories_ed_post_rating = get_post_meta( $post->ID, 'top_stories_ed_post_rating', true ); ?>

    <div class="singular-main-block">
        <div class="wrapper">
            <div class="column-row">

                <div id="primary" class="content-area">
                    <main id="main" class="site-main <?php if( $top_stories_ed_post_rating ){ echo 'top-stories-no-comment'; } ?>" role="main">

                        <?php
                        if( !is_home() && !is_front_page() && ( isset( $breadcrumb ) || $top_stories_post_layout != 'layout-2' ) ) {
                            top_stories_breadcrumb_with_title_block();
                        }

                        if( have_posts() ): ?>

                            <div class="article-wraper single-layout <?php echo esc_attr($article_wrap_class.$single_layout_class); ?>">

                                <?php while (have_posts()) :
                                    the_post();

                                    get_template_part('template-parts/content', 'single');

                                    /**
                                     *  Output comments wrapper if it's a post, or if comments are open,
                                     * or if there's a comment number – and check for password.
                                    **/
                                    if ( $top_stories_header_trending_page != $current_id && $top_stories_header_popular_page != $current_id ) {

                                        if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && !post_password_required() ) { ?>

                                            <div class="comments-wrapper">
                                                <?php comments_template(); ?>
                                            </div>

                                        <?php
                                        }
                                    }

                                endwhile; ?>

                            </div>

                        <?php
                        else :

                            get_template_part('template-parts/content', 'none');

                        endif;

                        /**
                         * Navigation
                         * 
                         * @hooked top_stories_post_floating_nav - 10
                         * @hooked top_stories_related_posts - 20  
                         * @hooked top_stories_single_post_navigation - 30  
                        */

                        do_action('top_stories_navigation_action'); ?>

                    </main><!-- #main -->
                </div>

                <?php
                if( class_exists('WooCommerce') && ( is_cart() || is_checkout() ) ){
                    $sidebar_status = false;
                }else{
                    $sidebar_status = true;
                }
                if ( $sidebar != 'no-sidebar' && $sidebar_status ) {
                    get_sidebar();
                } ?>

            </div>
        </div>
    </div>

<?php
get_footer();
