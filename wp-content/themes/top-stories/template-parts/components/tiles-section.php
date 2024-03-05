<?php
/**
 * Tiles Blocks
 *
 * @package Top Stories
 */
if (!function_exists('top_stories_tiles_block_section')):
    function top_stories_tiles_block_section($top_stories_home_section,$repeat_times){

        $section_category = esc_html( isset($top_stories_home_section->section_category) ? $top_stories_home_section->section_category : '');
        $tiles_post_per_page = esc_html( isset($top_stories_home_section->tiles_post_per_page) ? $top_stories_home_section->tiles_post_per_page : 5);
        $home_section_title = isset($top_stories_home_section->home_section_title) ? $top_stories_home_section->home_section_title : '';
        
        $tiles_post_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => $tiles_post_per_page,'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $section_category ) ) );
        if( $tiles_post_query ->have_posts() ):

            $post_ids = array();
            while( $tiles_post_query ->have_posts() ){
                $tiles_post_query ->the_post();

                $post_ids[] = get_the_ID();

            }

            $posts_id = array();
            if( $post_ids && count( $post_ids ) > 5 ){

                $posts_id = array_chunk($post_ids,5);

            }else{

                $posts_id[] = $post_ids;

            }
            if( empty( $home_section_title ) && $section_category ){

                $catObj = get_category_by_slug( $section_category );
                if( isset($catObj->name) && $catObj->name ){
                    $home_section_title = $catObj->name;
                }

            } ?>
            <div id="theme-block-<?php echo esc_attr($repeat_times); ?>" class="theme-block theme-block-tiles">
                <div class="wrapper">
                    <div class="column-row">
                        <?php if( $home_section_title || $section_category ){ ?>

                            <div class="column column-12 column-sm-12">
                                <header class="block-title-wrapper">

                                    <?php if( $home_section_title ){ ?>

                                        <h2 class="block-title">
                                            <span><?php echo esc_html( $home_section_title ); ?></span>
                                        </h2>

                                    <?php } ?>

                                    <?php if( $section_category ){

                                        $catObj = get_category_by_slug( $section_category );
                                        if( isset($catObj->name) && $catObj->name ){
                                            $cat_title = $catObj->name;
                                        }
                                        $cat_link = get_category_link( $catObj->term_id ); ?>

                                        <div class="theme-heading-controls">
                                            <a href="<?php echo esc_url($cat_link); ?>" class="view-all-link">
                                                <span class="view-all-icon"><?php top_stories_theme_svg('plus'); ?></span>
                                                <span class="view-all-label"><?php esc_html_e('View All', 'top-stories'); ?></span>
                                            </a>
                                        </div>

                                    <?php } ?>

                                </header>

                            </div>

                        <?php } ?>

                        <?php
                        foreach( $posts_id as $post_id ){

                            $post_ids_1 = array();
                            $post_ids_2 = array();
                            if( isset( $post_id[ 0 ] ) && $post_id[ 0 ] ){

                                $post_ids_1[] = $post_id[ 0 ];

                            }
                            if( isset( $post_id[ 1 ] ) && $post_id[ 1 ] ){

                                $post_ids_2[] = $post_id[ 1 ];

                            }

                            if( isset( $post_id[ 2 ] ) && $post_id[ 2 ] ){

                                $post_ids_2[] = $post_id[ 2 ];

                            }

                            if( isset( $post_id[ 3 ] ) && $post_id[ 3 ] ){

                                $post_ids_2[] = $post_id[ 3 ];

                            }

                            if( isset( $post_id[ 4 ] ) && $post_id[ 4 ] ){

                                $post_ids_2[] = $post_id[ 4 ];

                            }

                            if( $post_ids_1 ){

                                $tiles_query_1 = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 1,'post__not_in' => get_option("sticky_posts"), 'post__in' =>  $post_ids_1 ) );

                                if( $tiles_query_1 ->have_posts() ){

                                    while( $tiles_query_1 ->have_posts() ){
                                        $tiles_query_1 ->the_post();
                                        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                        $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : '';
                                        ?>
                                        <div class="column column-6 column-md-12 column-sm-12">

                                            <article id="theme-post-<?php the_ID(); ?>" <?php post_class( 'news-article news-article-panel' ); ?>>
                                                <div class="data-bg data-bg-large thumb-overlay img-hover-slide" data-background="<?php echo esc_url( $featured_image ); ?>">

                                                    <?php
                                                    $format = get_post_format( get_the_ID() ) ? : 'standard';
                                                    $icon = top_stories_post_format_icon( $format );
                                                    if( !empty( $icon ) ){ ?>
                                                        <span class="top-right-icon">
                                                                <?php echo top_stories_svg_escape( $icon ); ?>
                                                            </span>
                                                    <?php } ?>

                                                    <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>

                                                    <div class="article-content article-content-overlay">
                                                        <div class="entry-meta">
                                                            <?php top_stories_entry_footer( $cats = true, $tags = false, $edits = false, $text = false, $icon = false ); ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="article-content theme-article-content">
                                                    <h3 class="entry-title entry-title-big">
                                                        <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                    </h3>

                                                    <div class="entry-meta">
                                                        <?php top_stories_posted_by(); ?>
                                                        <?php top_stories_post_view_count(); ?>
                                                    </div>

                                                    <div class="entry-content hidden-xs-element entry-content-muted">
                                                        <?php
                                                        if (has_excerpt()) {
                                                            the_excerpt();
                                                        } else {
                                                            echo '<p>';
                                                            echo esc_html( wp_trim_words( get_the_content(),10,'...' ) );
                                                            echo '</p>';
                                                        } ?>
                                                    </div>
                                                </div>
                                            </article>

                                        </div>

                                    <?php
                                    }
                                }
                            }

                            if( $post_ids_2 ){

                                $tiles_query_2 = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 4,'post__not_in' => get_option("sticky_posts"), 'post__in' =>  $post_ids_2 ) );

                                if( $tiles_query_2 ->have_posts() ){ ?>

                                    <div class="column column-6 column-md-12 column-sm-12">

                                        <div class="column-row">

                                            <?php
                                            while( $tiles_query_2 ->have_posts() ){
                                                $tiles_query_2 ->the_post();
                                                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                                ?>
                                                <div class="column column-6 column-xxs-12">

                                                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class( 'news-article news-article-panel' ); ?>>
                                                        <div class="data-bg data-bg-medium thumb-overlay img-hover-slide" data-background="<?php echo esc_url( $featured_image[0] ); ?>">

                                                            <?php
                                                            $format = get_post_format( get_the_ID() ) ? : 'standard';
                                                            $icon = top_stories_post_format_icon( $format );
                                                            if( !empty( $icon ) ){ ?>
                                                                <span class="top-right-icon">
                                                                    <?php echo top_stories_svg_escape( $icon ); ?>
                                                                </span>
                                                            <?php } ?>
                                                            <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                                            <div class="article-content article-content-overlay">
                                                                <div class="entry-meta">
                                                                    <?php top_stories_entry_footer( $cats = true, $tags = false, $edits = false, $text = false, $icon = false ); ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="article-content theme-article-content">
                                                            <h3 class="entry-title entry-title-medium">
                                                                <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                            </h3>
                                                            <div class="entry-meta">
                                                                <?php top_stories_posted_by(); ?>
                                                                <?php top_stories_post_view_count(); ?>
                                                            </div>
                                                        </div>
                                                    </article>

                                                </div>

                                            <?php } ?>

                                        </div>

                                    </div>

                                <?php
                                }
                            }

                        } ?>
                    </div>
                </div>
            </div>

        <?php
        wp_reset_postdata();
        endif;

    }
endif;