<?php
/**
 * You May Like Blocks
 *
 * @package Top Stories
 */
if (!function_exists('top_stories_you_may_like_block_section')):
    function top_stories_you_may_like_block_section($top_stories_home_section,$repeat_times){

        $section_category = esc_html( isset($top_stories_home_section->section_category) ? $top_stories_home_section->section_category : '');
        $home_section_title = isset($top_stories_home_section->home_section_title) ? $top_stories_home_section->home_section_title : '';
        $you_may_like_post_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => '4','post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $section_category ) ) );
        if( $you_may_like_post_query ->have_posts() ): ?>

            <div id="theme-block-<?php echo esc_attr($repeat_times); ?>" class="theme-block theme-block-recommended">
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


                        <?php if( $you_may_like_post_query ->have_posts() ){

                            while( $you_may_like_post_query ->have_posts() ){
                                $you_may_like_post_query ->the_post();
                                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : '';
                                ?>

                                <div class="column column-3 column-sm-6 column-xs-12">
                                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class( 'news-article news-article-panel' ); ?>>
                                        <div class="data-bg data-bg-small thumb-overlay img-hover-slide" data-background="<?php echo esc_url( $featured_image ); ?>">
                                            <?php
                                            $format = get_post_format(get_the_ID()) ?: 'standard';
                                            $icon = top_stories_post_format_icon($format);
                                            if (!empty($icon)) { ?>
                                                <span class="top-right-icon">
                                                                        <?php echo top_stories_svg_escape($icon); ?>
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

                            <?php
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