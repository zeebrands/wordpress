<?php
/**
 * Latest Posts
 *
 * @package Top Stories
 */
if( !function_exists('top_stories_latest_blocks') ):
    
    function top_stories_latest_blocks($top_stories_home_section,$repeat_times){

        global $post;
        $top_stories_default = top_stories_get_default_theme_options();
        $sidebar = esc_attr( get_theme_mod( 'global_sidebar_layout', $top_stories_default['global_sidebar_layout'] ) );

        $top_stories_archive_layout = esc_attr( get_theme_mod( 'top_stories_archive_layout', $top_stories_default['top_stories_archive_layout'] ) ); ?>
        <div id="theme-block-<?php echo esc_attr( $repeat_times ); ?>" class="theme-block theme-block-archive">
            <div class="wrapper">
                <div class="column-row">
                    <div id="primary" class="content-area has-sticky-enabled">
                        <main id="main" class="site-main" role="main">

                                <?php
                                if( !is_front_page() ) {
                                    top_stories_breadcrumb_with_title_block();
                                }

                                if( have_posts() ): ?>

                                    <div class="article-wraper archive-layout <?php echo 'archive-layout-' . esc_attr( $top_stories_archive_layout ); ?>">
                                        <?php while (have_posts()) :
                                            the_post();

                                            if( !is_page() ){

                                                get_template_part( 'template-parts/content', get_post_format() );
                                                
                                            }else{
                                                get_template_part('template-parts/content', 'single');
                                            }


                                        endwhile; ?>
                                    </div>

                                    <?php if( !is_page() ): do_action('top_stories_archive_pagination'); endif;

                                else :

                                    get_template_part('template-parts/content', 'none');

                                endif; ?>

                        </main><!-- #main -->
                    </div>

                    <?php if( $sidebar != 'no-sidebar' ){

                        get_sidebar();
                        
                    } ?>
                </div>
            </div>
        </div>

    <?php
    }
    
endif;
