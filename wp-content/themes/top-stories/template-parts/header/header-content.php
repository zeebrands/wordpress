<?php
/**
 * Header Layout 2
 *
 * @package Top Stories
 */
$top_stories_default = top_stories_get_default_theme_options();
$ed_header_new_entry_posts = get_theme_mod( 'ed_header_new_entry_posts', $top_stories_default['ed_header_new_entry_posts'] );
$top_stories_header_bg_size = get_theme_mod( 'top_stories_header_bg_size', $top_stories_default['top_stories_header_bg_size'] );
$ed_header_bg_fixed = get_theme_mod( 'ed_header_bg_fixed', $top_stories_default['ed_header_bg_fixed'] );
$ed_header_bg_overlay = get_theme_mod( 'ed_header_bg_overlay', $top_stories_default['ed_header_bg_overlay'] ); ?>

<header id="site-header" class="theme-header <?php if( $ed_header_bg_overlay ){ echo 'header-overlay-enabled'; } ?>" role="banner">
    <div class="header-topbar hidden-sm-element">
        <div class="wrapper header-wrapper">
            <div class="header-item header-item-left">
                <?php top_stories_header_ticker_posts(); ?>
            </div>
            <div class="header-item header-item-right">
                <div class="ticker-controls">
                    <button type="button" class="slide-btn theme-aria-button slide-prev-ticker">
                        <span class="btn__content" tabindex="-1">
                            <?php top_stories_theme_svg('chevron-left'); ?>
                        </span>
                    </button>

                    <button type="button" class="slide-btn theme-aria-button ticker-control ticker-control-play">
                        <span class="btn__content" tabindex="-1">
                            <?php top_stories_theme_svg('play'); ?>
                        </span>
                    </button>

                    <button type="button" class="slide-btn theme-aria-button ticker-control ticker-control-pause pp-button-active">
                        <span class="btn__content" tabindex="-1">
                            <?php top_stories_theme_svg('pause'); ?>
                        </span>
                    </button>

                    <button type="button" class="slide-btn theme-aria-button slide-next-ticker">
                        <span class="btn__content" tabindex="-1">
                            <?php top_stories_theme_svg('chevron-right'); ?>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="header-mainbar <?php if( get_header_image() ){ if( $ed_header_bg_fixed ){ echo 'data-bg-fixed'; } ?> data-bg header-bg-<?php echo esc_attr( $top_stories_header_bg_size ); ?> <?php } ?> "  <?php if( get_header_image() ){ ?> data-background="<?php echo esc_url(get_header_image()); ?>" <?php } ?>>
        <div class="wrapper header-wrapper">
            <div class="header-item header-item-left">
                <div class="header-titles">
                    <?php
                    top_stories_site_logo();
                    top_stories_site_description();
                    ?>
                </div>
            </div>
            <?php  if ($ed_header_new_entry_posts) { ?>
                <div class="header-item header-item-right hidden-sm-element ">
                    <div class="header-latest-entry">
                        <?php top_stories_content_new_entry_news_render(); ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php top_stories_date_ticker_bar(); ?>
    
    <div class="header-navbar">
        <div class="wrapper header-wrapper">
            <div class="header-item header-item-left">

                <div class="header-navigation-wrapper">
                    <div class="site-navigation">
                        <nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e('Horizontal', 'top-stories'); ?>" role="navigation">
                            <ul class="primary-menu theme-menu">
                                <?php
                                if( has_nav_menu('top-stories-primary-menu') ){

                                    wp_nav_menu(
                                        array(
                                            'container' => '',
                                            'items_wrap' => '%3$s',
                                            'theme_location' => 'top-stories-primary-menu',
                                            'walker' => new top_stories\Top_Stories_Walkernav(),
                                        )
                                    );

                                }else{

                                    wp_list_pages(
                                        array(
                                            'match_menu_classes' => true,
                                            'show_sub_menu_icons' => true,
                                            'title_li' => false,
                                            'walker' => new Top_Stories_Walker_Page(),
                                        )
                                    );

                                } ?>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>

            <div class="header-item header-item-right">
                <?php main_navigation_extras(); ?>
            </div>
        </div>
        <?php top_stories_content_trending_news_render(); ?>
    </div>

</header>
