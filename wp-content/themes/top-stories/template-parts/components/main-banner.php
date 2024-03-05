<?php
/**
 * Advertise
 *
 * @package Top Stories
 */
if (!function_exists('top_stories_main_banner')):
    function top_stories_main_banner($top_stories_home_section,$repeat_times){
        $section_post_slide_cat = esc_html(isset($top_stories_home_section->section_post_slide_cat) ? $top_stories_home_section->section_post_slide_cat : '');
        $section_post_grid_post_cat = esc_html(isset($top_stories_home_section->section_post_grid_post_cat) ? $top_stories_home_section->section_post_grid_post_cat : '');
        $section_post_list_post_cat = esc_html(isset($top_stories_home_section->section_post_list_post_cat) ? $top_stories_home_section->section_post_list_post_cat : '');
        $section_post_cat_1 = esc_html(isset($top_stories_home_section->section_post_cat_1) ? $top_stories_home_section->section_post_cat_1 : '');
        $section_vertical_list_category = esc_html(isset($top_stories_home_section->section_vertical_list_category) ? $top_stories_home_section->section_vertical_list_category : '');

        $slider_arrows = esc_html(isset($top_stories_home_section->ed_arrows_carousel) ? $top_stories_home_section->ed_arrows_carousel : '');
        $slider_dots = esc_html(isset($top_stories_home_section->ed_dots_carousel) ? $top_stories_home_section->ed_dots_carousel : '');
        $slider_autoplay = esc_html(isset($top_stories_home_section->ed_autoplay_carousel) ? $top_stories_home_section->ed_autoplay_carousel : '');
        $home_section_title_4 = isset($top_stories_home_section->home_section_title_4) ? $top_stories_home_section->home_section_title_4 : '';
        $home_section_title_1 = isset($top_stories_home_section->home_section_title_1) ? $top_stories_home_section->home_section_title_1 : '';
        $home_section_title_3 = isset($top_stories_home_section->home_section_title_3) ? $top_stories_home_section->home_section_title_3 : '';

        if ($slider_arrows == 'yes' || $slider_arrows == '') {
            $arrow = 'true';
        } else {
            $arrow = 'false';
        }
        if ($slider_autoplay == 'yes' || $slider_autoplay == '') {
            $autoplay = 'true';
        } else {
            $autoplay = 'false';
        }
        if ($slider_dots == 'yes') {
            $dots = 'true';
        } else {
            $dots = 'false';
        }
        if (is_rtl()) {
            $rtl = 'true';
        } else {
            $rtl = 'false';
        }
        $banner_query_1 = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 5, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_post_cat_1)));
        $banner_query_2 = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 4, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_post_slide_cat)));

        $banner_query_4 = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 3, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_post_grid_post_cat)));
        $banner_query_5 = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 10, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_post_list_post_cat)));


        $banner_query_3 = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 10, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_vertical_list_category))); ?>
        <div id="theme-block-<?php echo esc_attr( $repeat_times ); ?>" class="theme-block theme-main-banner">
            <div class="wrapper">
                <div class="column-row column-row-large">
                    <div class="column column-6 column-md-12 column-sm-12 mb-md-20 column-order-2 border-md-highlight">
                    <?php if ($banner_query_2->have_posts()): ?>
                        <div class="block-sub-area block-upper-area">
                            <?php if( $home_section_title_1 ){ ?>
                                <header class="block-title-wrapper">
                                    <?php if( $home_section_title_1 ){ ?>
                                        <h2 class="block-title">
                                            <span><?php echo esc_html( $home_section_title_1 ); ?></span>
                                        </h2>
                                    <?php } ?>
                                    <?php if( $arrow == 'true' ){ ?>
                                        <div class="theme-heading-controls">
                                            <button type="button" class="slide-btn slide-btn-small slide-prev-lead">
                                                <?php top_stories_theme_svg('chevron-left'); ?>
                                            </button>
                                            <button type="button" class="slide-btn slide-btn-small slide-next-lead">
                                                <?php top_stories_theme_svg('chevron-right'); ?>
                                            </button>
                                        </div>
                                    <?php } ?>
                                </header>
                            <?php } ?>
                            <div class="theme-slider-wrapper">
                                <div class="theme-main-slider-block"
                                     data-slick='{"arrows": <?php echo esc_attr($arrow); ?>,"autoplay": <?php echo esc_attr($autoplay); ?>, "dots": <?php echo esc_attr($dots); ?>, "rtl": <?php echo esc_attr($rtl); ?>}'>
                                    <?php
                                    while ($banner_query_2->have_posts()) {
                                        $banner_query_2->the_post();
                                        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                        $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>
                                        <div class="theme-slider-item">
                                            <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-panel'); ?>>

                                                <div class="data-bg data-bg-large thumb-overlay img-hover-slide"
                                                     data-background="<?php echo esc_url($featured_image); ?>">
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
                                                            <?php top_stories_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="article-content theme-article-content">
                                                    <h2 class="entry-title entry-title-big">
                                                        <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark"
                                                           title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                    </h2>

                                                    <div class="entry-footer">
                                                        <div class="entry-meta">
                                                            <?php top_stories_posted_by(); ?>
                                                            <?php top_stories_post_view_count(); ?>
                                                        </div>
                                                    </div>

                                                    <div class="entry-content hidden-xs-element entry-content-muted">
                                                        <?php
                                                        if (has_excerpt()) {
                                                            the_excerpt();
                                                        } else {
                                                            echo '<p>';
                                                            echo esc_html(wp_trim_words(get_the_content(), 25, '...'));
                                                            echo '</p>';
                                                        } ?>
                                                    </div>

                                                </div>
                                            </article>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php  wp_reset_postdata();
                    endif; ?>
                    <?php if ($banner_query_4->have_posts()): ?>
                        <div class="block-sub-area block-middle-area">
                            <div class="column-row column-row-small">
                                <?php
                                while ($banner_query_4->have_posts()) {
                                    $banner_query_4->the_post(); ?>
                                    <div class="column column-4 column-xxs-12">
                                        <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-panel'); ?>>
                                            <div class="article-content">
                                                <h3 class="entry-title entry-title-small">
                                                    <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark"
                                                       title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                </h3>

                                                <div class="entry-meta">
                                                    <?php top_stories_posted_on($icon = true); ?>
                                                    <?php top_stories_post_view_count(); ?>
                                                </div>

                                                <div class="entry-content hidden-xs-element entry-content-muted">
                                                    <?php
                                                    if (has_excerpt()) {
                                                        the_excerpt();
                                                    } else {
                                                        echo '<p>';
                                                        echo esc_html(wp_trim_words(get_the_content(), 25, '...'));
                                                        echo '</p>';
                                                    } ?>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <?php
                                } ?>
                            </div>
                        </div>
                    <?php  wp_reset_postdata();
                    endif; ?>
                    <?php if ($banner_query_5->have_posts()): ?>
                        <div class="block-sub-area block-lower-area">
                            <?php
                            while ($banner_query_5->have_posts()) {
                                $banner_query_5->the_post();
                                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>

                                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-list'); ?>>


                                        <div class="data-bg thumb-overlay img-hover-slide" data-background="<?php echo esc_url($featured_image); ?>">
                                            <?php
                                            $format = get_post_format(get_the_ID()) ?: 'standard';
                                            $icon = top_stories_post_format_icon($format);
                                            if (!empty($icon)) { ?>
                                                <span class="top-right-icon"><?php echo top_stories_svg_escape($icon); ?></span>
                                            <?php } ?>
                                            <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>

                                        </div>

                                            <div class="article-content theme-article-content">
                                                <div class="entry-meta">
                                                    <?php top_stories_entry_footer( $cats = true, $tags = false, $edits = false, $text = false, $icon = false ); ?>
                                                </div>

                                            <h3 class="entry-title entry-title-medium">
                                                <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                            </h3>

                                            <div class="entry-meta">
                                                <?php top_stories_posted_on( $icon = true ); ?>
                                                <?php top_stories_post_view_count(); ?>
                                            </div>
                                        </div>

                                    </article>

                                <?php
                            } ?>
                        </div>
                        <?php  wp_reset_postdata();
                        endif; ?>
                    </div>

                    <?php if ($banner_query_3->have_posts()): ?>
                        <div class="column column-3 column-md-6 column-sm-6 column-xs-12 mb-md-20 column-order-3 has-sticky-enabled">
                            <?php if( $home_section_title_3 ){ ?>
                                <header class="block-title-wrapper">
                                    <?php if( $home_section_title_3 ){ ?>
                                        <h2 class="block-title">
                                            <span><?php echo esc_html( $home_section_title_3 ); ?></span>
                                        </h2>
                                    <?php } ?>
                                </header>
                            <?php } ?>
                            <div class="main-banner-right">
                                <?php
                                while ($banner_query_3->have_posts()) {
                                    $banner_query_3->the_post();
                                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
                                    $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>

                                        <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-instant'); ?>>

                                            <div class="article-content theme-article-content">

                                                <div class="entry-meta">
                                                    <?php top_stories_entry_footer( $cats = true, $tags = false, $edits = false, $text = false, $icon = false ); ?>
                                                </div>

                                                <h3 class="entry-title entry-title-small mb-15">
                                                    <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                </h3>

                                                <div class="column-row column-row-small">
                                                    <div class="column column-8 mb-15">
                                                        <div class="entry-meta">
                                                            <?php top_stories_posted_on( $icon = true ); ?>
                                                        </div>

                                                        <div class="entry-content entry-content-muted">
                                                            <?php
                                                            if (has_excerpt()) {
                                                                the_excerpt();
                                                            } else {
                                                                echo '<p>';
                                                                echo esc_html(wp_trim_words(get_the_content(), 25, '...'));
                                                                echo '</p>';
                                                            } ?>
                                                        </div>
                                                    </div>
                                                    <div class="column column-4">
                                                        <div class="data-bg data-bg-radius data-bg-thumbnail thumb-overlay" data-background="<?php echo esc_url($featured_image); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </article>

                                    <?php
                                } ?>
                            </div>
                        </div>
                        <?php
                        wp_reset_postdata();
                    endif;

                    if ($banner_query_1->have_posts()): ?>
                        <div class="column column-3 column-md-6 column-sm-6 column-xs-12 column-order-1 has-sticky-enabled">
                            <?php if( $home_section_title_4 ){ ?>
                                <header class="block-title-wrapper">
                                    <?php if( $home_section_title_4 ){ ?>
                                        <h2 class="block-title">
                                            <span><?php echo esc_html( $home_section_title_4 ); ?></span>
                                        </h2>
                                    <?php } ?>
                                </header>
                            <?php } ?>
                            <div class="main-banner-left">
                                <?php
                                while ($banner_query_1->have_posts()) {
                                    $banner_query_1->the_post();
                                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                    $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>

                                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-panel'); ?>>
                                        <div class="data-bg data-bg-medium thumb-overlay img-hover-slide" data-background="<?php echo esc_url($featured_image); ?>">
                                            <?php
                                            $format = get_post_format(get_the_ID()) ?: 'standard';
                                            $icon = top_stories_post_format_icon($format);
                                            if (!empty($icon)) { ?>
                                                <span class="top-right-icon"><?php echo top_stories_svg_escape($icon); ?></span>
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

                                    <?php
                                } ?>
                            </div>
                        </div>
                        <?php
                        wp_reset_postdata();
                    endif;

                    ?>
                </div>
            </div>
        </div>
    <?php }
endif; ?>