<?php
/**
 * Custom Functions
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Top Stories
 * @since 1.0.0
 */
if( !function_exists('top_stories_site_logo') ):

    /**
     * Logo & Description
     */
    /**
     * Displays the site logo, either text or image.
     *
     * @param array $args Arguments for displaying the site logo either as an image or text.
     * @param boolean $echo Echo or return the HTML.
     *
     * @return string $html Compiled HTML based on our arguments.
     */
    function top_stories_site_logo( $args = array(), $echo = true ){

        $logo = get_custom_logo();
        $site_title = get_bloginfo('name');
        $contents = '';
        $classname = '';
        $defaults = array(
            'logo' => '%1$s<span class="screen-reader-text">%2$s</span>',
            'logo_class' => 'site-logo site-branding',
            'title' => '<a href="%1$s" class="custom-logo-name">%2$s</a>',
            'title_class' => 'site-title',
            'home_wrap' => '<h1 class="%1$s">%2$s</h1>',
            'single_wrap' => '<div class="%1$s">%2$s</div>',
            'condition' => (is_front_page() || is_home()) && !is_page(),
        );
        $args = wp_parse_args($args, $defaults);
        /**
         * Filters the arguments for `top_stories_site_logo()`.
         *
         * @param array $args Parsed arguments.
         * @param array $defaults Function's default arguments.
         */
        $args = apply_filters('top_stories_site_logo_args', $args, $defaults);
        if ( has_custom_logo() ) {
            $contents = sprintf($args['logo'], $logo, esc_html($site_title));
            $contents .= sprintf($args['title'], esc_url( get_home_url(null, '/') ), esc_html($site_title));
            $classname = $args['logo_class'];
        } else {
            $contents = sprintf($args['title'], esc_url( get_home_url(null, '/') ), esc_html($site_title));
            $classname = $args['title_class'];
        }
        $wrap = $args['condition'] ? 'home_wrap' : 'single_wrap';
        $html = sprintf($args[$wrap], $classname, $contents);
        /**
         * Filters the arguments for `top_stories_site_logo()`.
         *
         * @param string $html Compiled html based on our arguments.
         * @param array $args Parsed arguments.
         * @param string $classname Class name based on current view, home or single.
         * @param string $contents HTML for site title or logo.
         */
        $html = apply_filters('top_stories_site_logo', $html, $args, $classname, $contents);
        if (!$echo) {
            return $html;
        }
        echo $html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

    }

endif;

if( !function_exists('top_stories_site_description') ):

    /**
     * Displays the site description.
     *
     * @param boolean $echo Echo or return the html.
     *
     * @return string $html The HTML to display.
     */
    function top_stories_site_description($echo = true){

        $description = get_bloginfo('description');
        if (!$description) {
            return;
        }
        $wrapper = '<div class="site-description"><span>%s</span></div><!-- .site-description -->';
        $html = sprintf($wrapper, esc_html($description));
        /**
         * Filters the html for the site description.
         *
         * @param string $html The HTML to display.
         * @param string $description Site description via `bloginfo()`.
         * @param string $wrapper The format used in case you want to reuse it in a `sprintf()`.
         * @since 1.0.0
         *
         */
        $html = apply_filters('top_stories_site_description', $html, $description, $wrapper);
        if (!$echo) {
            return $html;
        }
        echo $html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

    }

endif;

if( !function_exists('top_stories_posted_on') ):

    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function top_stories_posted_on($icon = false){

        $top_stories_default = top_stories_get_default_theme_options();
        $post_date_format = get_theme_mod( 'post_date_format',$top_stories_default['post_date_format'] );
        $ed_post_date = absint( get_theme_mod( 'ed_post_date',$top_stories_default['ed_post_date'] ) );

        if( $ed_post_date ){

            $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
            if (get_the_time('U') !== get_the_modified_time('U')) {
                $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
            }

            $time_string = sprintf($time_string,
                esc_attr(get_the_date(DATE_W3C)),
                esc_html(get_the_date()),
                esc_attr(get_the_modified_date(DATE_W3C)),
                esc_html(get_the_modified_date())
            );

            $year = get_the_date('Y');
            $month = get_the_date('m');
            $day = get_the_date('d');
            $link = get_day_link($year, $month, $day);
            

            if( $post_date_format == 'time-ago' ){

                $time_string = human_time_diff( get_the_date('U'), current_time('timestamp') ).esc_html__(' Ago','top-stories');

                $posted_on = '<a href="' . esc_url($link) . '" rel="bookmark">' . $time_string . '</a>';

            }else{

                $posted_on = '<a href="' . esc_url($link) . '" rel="bookmark">' . $time_string . '</a>';

            }
            

            echo '<div class="entry-meta-item entry-meta-date">';

            if( $icon ){
                echo '<span class="entry-meta-icon calendar-icon"> ';
                top_stories_theme_svg('calendar');
                echo '</span>';
            }

            echo $posted_on; // WPCS: XSS OK.

            echo '</div>';

        }

    }

endif;

if( !function_exists('top_stories_posted_by') ) :

    /**
     * Prints HTML with meta information for the current author.
     */
    function top_stories_posted_by(){   


        $byline = '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta('ID') ) ) . '">' . esc_html(get_the_author()) . '</a>';

        echo '<div class="entry-meta-item entry-meta-byline"> ' . $byline . '</div>';
        echo '<div class="entry-meta-separator"></div>';
        top_stories_posted_on();


    }

endif;

if( !function_exists('top_stories_posted_by_name_only') ) :

    /**
     * Prints HTML with meta information for the current author.
     */
    function top_stories_posted_by_name_only(){   


        $byline = '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta('ID') ) ) . '">' . esc_html(get_the_author()) . '</a>';

        echo '<div class="entry-meta-item entry-meta-byline"> ' . $byline . '</div>';

    }

endif;

if( !function_exists('top_stories_entry_footer') ):

    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function top_stories_entry_footer( $cats = true, $tags = true, $edits = true, $text = true, $icon = true ){   

        $top_stories_default = top_stories_get_default_theme_options();
        $ed_post_category = absint( get_theme_mod( 'ed_post_category',$top_stories_default['ed_post_category'] ) );
        $ed_post_tags = absint( get_theme_mod( 'ed_post_tags',$top_stories_default['ed_post_tags'] ) );

        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {

            if( $cats && $ed_post_category ){

                /* translators: used between list items, there is a space after the comma */
                $categories = get_the_category();
                if ($categories) {
                    echo '<div class="entry-meta-item entry-meta-categories">';

                    if( $icon ){
                        echo '<span class="entry-meta-icon categories-icon"> ';
                        top_stories_theme_svg('folder');
                        echo '</span>';
                    }

                    if( $text ){
                        echo '<span class="entry-meta-label categories-label">';
                        esc_html_e('In', 'top-stories');
                        echo '</span>';
                    }

                    /* translators: 1: list of categories. */
                
                        foreach( $categories as $category ){

                            $cat_name = $category->name;
                            $cat_slug = $category->slug;
                            $cat_url = get_category_link( $category->term_id );

                            $twp_term_color = get_term_meta( $category->term_id, 'top-stories-cat-color', true ); ?>

                            <a <?php if( $twp_term_color ){ ?>style="background: <?php echo esc_attr( $twp_term_color ); ?>" <?php } ?> href="<?php echo esc_url( $cat_url ); ?>" rel="category tag">
                                <?php echo esc_html( $cat_name ); ?>
                            </a>

                        <?php }

                    echo '</div>';
                }

            }

            if( $tags && $ed_post_tags ){
                /* translators: used between list items, there is a space after the comma */
                $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'top-stories'));
                if( $tags_list ){

                    echo '<div class="entry-meta-item entry-meta-tags">';
                    echo '<span class="entry-meta-icon tags-icon"> ';
                    top_stories_theme_svg('tag');
                    echo '</span>';

                    echo '<span class="entry-meta-label tags-label">';
                    esc_html_e('In', 'top-stories');
                    echo '</span>';

                    /* translators: 1: list of tags. */
                    echo '<span class="tags-links">';
                    echo wp_kses_post($tags_list) . '</span>'; // WPCS: XSS OK.
                    echo '</div>';

                }

            }

            if( $edits ){

                edit_post_link(
                    sprintf(
                        wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                            __('Edit <span class="screen-reader-text">%s</span>', 'top-stories'),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        get_the_title()
                    ),
                    '<div class="entry-meta-item edit-link">',
                    '</div>'
                );
            }

        }
    }

endif;

if ( !function_exists('top_stories_post_thumbnail') ) :

    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function top_stories_post_thumbnail($image_size = 'full'){

        if( post_password_required() || is_attachment() || !has_post_thumbnail() ){ return; }

        if ( is_singular() ) : ?>
                <?php the_post_thumbnail(); ?>
        <?php else : ?>

            <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php
                the_post_thumbnail($image_size, array(
                    'alt' => the_title_attribute(array(
                        'echo' => false,
                    )),
                )); ?>
            </a>

        <?php

        endif; // End is_singular().

    }

endif;

if( !function_exists('top_stories_is_comment_by_post_author') ):

    /**
     * Comments
     */
    /**
     * Check if the specified comment is written by the author of the post commented on.
     *
     * @param object $comment Comment data.
     *
     * @return bool
     */
    function top_stories_is_comment_by_post_author($comment = null){

        if (is_object($comment) && $comment->user_id > 0) {
            $user = get_userdata($comment->user_id);
            $post = get_post($comment->comment_post_ID);
            if (!empty($user) && !empty($post)) {
                return $comment->user_id === $post->post_author;
            }
        }
        return false;
    }

endif;

if( !function_exists('top_stories_breadcrumb_with_title_block') ) :

    /**
     * Top Stories Breadcrumb
     */
    function top_stories_breadcrumb_with_title_block($comment = null){

            $top_stories_default = top_stories_get_default_theme_options();
            $ed_breadcrumb = absint( get_theme_mod( 'ed_breadcrumb',$top_stories_default['ed_breadcrumb'] ) );
            if ($ed_breadcrumb) {
                echo '<div class="entry-breadcrumb">';
                    breadcrumb_trail();
                echo '</div>';
            }
        if( is_search() ){ ?>
            <div class="twp-banner-details">
                <header class="page-header">
                    <h1 class="page-title">
                        <?php
                        /* translators: %s: search query. */
                        printf( esc_html__( 'Search Results for: %s', 'top-stories' ), '<span>' . get_search_query() . '</span>' );
                        ?>
                    </h1>
                </header><!-- .page-header -->
            </div>
        <?php } ?>

        <?php
        if( is_archive() && !is_author() ){ ?>

            <div class="twp-banner-details">
                <header class="page-header">
                    <?php
                    the_archive_title( '<h1 class="page-title">', '</h1>' );
                    the_archive_description( '<div class="archive-description">', '</div>' );
                    ?>
                </header><!-- .page-header -->
            </div>
            
        <?php }

        if( is_author() ){ ?>
            <div class="twp-banner-details">
                <header class="page-header">

                    <?php
                    $curauth = ( get_query_var( 'author_name' ) ) ? get_user_by( 'slug', get_query_var( 'author_name' ) ) : get_userdata( get_query_var( 'author' ) );
                    $author_img = get_avatar( absint( $curauth->ID ),200, '', '', array('class' => 'avatar-img') ); ?>

                    <div class="author-image">
                        <?php echo wp_kses_post( $author_img ); ?>
                    </div>

                    <div class="author-title-desc">
                        <h1 class="page-title"><?php echo esc_html( $curauth->nickname ); ?></h1>
                        <div class="archive-description"><?php echo esc_html( get_the_author_meta('description',absint( $curauth->ID ) ) ); ?></div>
                    </div>

                </header><!-- .page-header -->
            </div>
        <?php }

    }

endif;
