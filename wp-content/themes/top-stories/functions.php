<?php
/**
 * Top Stories functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Top Stories
 */


if ( ! function_exists( 'top_stories_after_theme_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */

	function top_stories_after_theme_support() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Custom background color.
		add_theme_support('custom-background', apply_filters('top_stories_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

		// This variable is intended to be overruled from themes.
		// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$GLOBALS['content_width'] = apply_filters( 'top_stories_content_width', 1140 );
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size('top-stories-500-300',500,300,true);

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 120,
				'width'       => 90,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			)
		);

		/*
		 * Posts Format.
		 *
		 * https://wordpress.org/support/article/post-formats/
		 */
		add_theme_support( 'post-formats', array(
		    'video',
		    'audio',
		    'gallery',
		    'quote',
		    'image'
		) );

		// Woocommerce Support
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Top Stories, use a find and replace
		 * to change 'top-stories' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'top-stories', get_template_directory() . '/languages' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

        add_theme_support( 'responsive-embeds' );

        add_theme_support( 'wp-block-styles' );

	}

endif;

add_action( 'after_setup_theme', 'top_stories_after_theme_support' );

function top_stories_next_posts_link( $max_page = 0 ) {
    global $paged, $wp_query;

    if ( ! $max_page ) {
        $max_page = $wp_query->max_num_pages;
    }

    if ( ! $paged ) {
        $paged = 1;
    }

    $next_page = (int) $paged + 1;
    if ( ( $next_page <= $max_page ) ) {
        /**
         * Filters the anchor tag attributes for the next posts page link.
         *
         * @since 2.7.0
         *
         * @param string $attributes Attributes for the anchor tag.
         */
        $attr = apply_filters( 'next_posts_link_attributes', '' );

        return sprintf(next_posts( $max_page, false ));
    }
}

/**
 * Register and Enqueue Styles.
 */
function top_stories_register_styles() {

	$theme_version = wp_get_theme()->get( 'Version' );
	
	$fonts_url = top_stories_fonts_url();
    if( $fonts_url ){
    	
    	require_once get_theme_file_path( 'assets/lib/custom/css/wptt-webfont-loader.php' );
        wp_enqueue_style(
			'top-stories-google-fonts',
			wptt_get_webfont_url( $fonts_url ),
			array(),
			$theme_version
		);
    }

    wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/lib/magnific-popup/magnific-popup.css' );
    wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/lib/slick/css/slick.min.css');
	wp_enqueue_style( 'top-stories-style', get_stylesheet_uri(), array(), $theme_version );
    wp_style_add_data( 'top-stories-style', 'rtl', 'replace' );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}	

	wp_enqueue_script( 'imagesloaded' );
    wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/lib/magnific-popup/jquery.magnific-popup.min.js', array('jquery'), '', 1 );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/lib/slick/js/slick.min.js', array('jquery'), '', 1);
    wp_enqueue_script( 'top-stories-ajax', get_template_directory_uri() . '/assets/lib/custom/js/ajax.js', array('jquery'), '', 1 );
	wp_enqueue_script( 'top-stories-custom', get_template_directory_uri() . '/assets/lib/custom/js/custom.js', array('jquery'), '', 1);
	wp_enqueue_script( 'top-stories-pagination', get_template_directory_uri() . '/assets/lib/custom/js/pagination.js', array('jquery'), '', 1 );
	
    $ajax_nonce = wp_create_nonce('top_stories_ajax_nonce');

    wp_localize_script( 
        'top-stories-ajax', 
        'top_stories_ajax',
        array(
            'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
            'ajax_nonce' => $ajax_nonce,

         )
    );

    // Global Query
    if( is_front_page() ){

    	$posts_per_page = absint( get_option('posts_per_page') );
        $c_paged = ( get_query_var( 'page' ) ) ? absint( get_query_var( 'page' ) ) : 1;
        $posts_args = array(
            'posts_per_page'        => $posts_per_page,
            'paged'                 => $c_paged,
        );
        $posts_qry = new WP_Query( $posts_args );
        $max = $posts_qry->max_num_pages;

    }else{
        global $wp_query;
        $max = $wp_query->max_num_pages;
        $c_paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
    }

    $top_stories_default = top_stories_get_default_theme_options();
    $top_stories_pagination_layout = get_theme_mod( 'top_stories_pagination_layout',$top_stories_default['top_stories_pagination_layout'] );

    // Pagination Data
    wp_localize_script( 
	    'top-stories-pagination', 
	    'top_stories_pagination',
	    array(
	        'paged'  => absint( $c_paged ),
	        'maxpage'   => absint( $max ),
            'nextLink'   => top_stories_next_posts_link($max ),
	        'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
	        'loadmore'   => esc_html__( 'Load More Posts', 'top-stories' ),
	        'nomore'     => esc_html__( 'No More Posts', 'top-stories' ),
	        'loading'    => esc_html__( 'Loading...', 'top-stories' ),
	        'pagination_layout'   => esc_html( $top_stories_pagination_layout ),
	        'ajax_nonce' => $ajax_nonce,
	     )
	);

    global $post;
    $single_post = 0;
    $top_stories_ed_post_reaction = '';
    if( isset( $post->ID ) && isset( $post->post_type ) && $post->post_type == 'post' ){

    	$top_stories_ed_post_reaction = esc_html( get_post_meta( $post->ID, 'top_stories_ed_post_reaction', true ) );
    	$single_post = 1;

    }
	wp_localize_script(
	    'top-stories-custom', 
	    'top_stories_custom',
	    array(
	    	'single_post'						=> absint( $single_post ),
	        'top_stories_ed_post_reaction'  		=> esc_html( $top_stories_ed_post_reaction ),
	        'next_svg'   => top_stories_theme_svg('chevron-right',true),
            'prev_svg' => top_stories_theme_svg('chevron-left',true),
            'play' => top_stories_theme_svg( 'play', $return = true ),
            'pause' => top_stories_theme_svg( 'pause', $return = true ),
            'mute' => top_stories_theme_svg( 'mute', $return = true ),
            'unmute' => top_stories_theme_svg( 'unmute', $return = true ),
            'play_text' => esc_html__('Play','top-stories'),
            'pause_text' => esc_html__('Pause','top-stories'),
            'mute_text' => esc_html__('Mute','top-stories'),
            'unmute_text' => esc_html__('Unmute','top-stories'),
	     )
	);

}

add_action( 'wp_enqueue_scripts', 'top_stories_register_styles' );

/**
 * Admin enqueue script
 */
function top_stories_admin_scripts($hook){

	$current_screen = get_current_screen();
	wp_enqueue_style('top-stories-admin', get_template_directory_uri() . '/assets/lib/custom/css/admin.css');
    if( $current_screen->id != "widgets" ) {

		wp_enqueue_media();
		wp_enqueue_style( 'wp-color-picker' );
	    
	    wp_enqueue_script('top-stories-admin', get_template_directory_uri() . '/assets/lib/custom/js/admin.js', array('jquery','wp-color-picker'), '', 1);

	    $ajax_nonce = wp_create_nonce('top_stories_ajax_nonce');
				
		wp_localize_script( 
	        'top-stories-admin', 
	        'top_stories_admin',
	        array(
	            'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
	            'ajax_nonce' => $ajax_nonce,
	            'upload_image'   =>  esc_html__('Choose Image','top-stories'),
	            'use_image'   =>  esc_html__('Select','top-stories'),
	            'active' => esc_html__('Active','top-stories'),
		        'deactivate' => esc_html__('Deactivate','top-stories'),
	         )
	    );

	}

    if( $current_screen->id === "widgets" ) {

        // Enqueue Script Only On Widget Page.
        wp_enqueue_media();
    	wp_enqueue_script('top-stories-widget', get_template_directory_uri() . '/assets/lib/custom/js/widget.js', array('jquery'), '', 1);
	}
    
}

add_action('admin_enqueue_scripts', 'top_stories_admin_scripts');


add_filter('wp_nav_menu_items', 'top_stories_add_admin_link', 1, 2);
function top_stories_add_admin_link($items, $args){
    if( $args->theme_location == 'top-stories-primary-menu' ){
        $item = '<li class="brand-home"><a title="'.esc_html__('Home','top-stories').'" href="'. esc_url( home_url() ) .'">' .top_stories_theme_svg('home',true). '</a></li>';
        $items = $item . $items;
    }
    return $items;
}

if( !function_exists( 'top_stories_js_no_js_class' ) ) :

	// js no-js class toggle
	function top_stories_js_no_js_class() { ?>

		<script>document.documentElement.className = document.documentElement.className.replace( 'no-js', 'js' );</script>
	
	<?php
	}
	
endif;

add_action( 'wp_head', 'top_stories_js_no_js_class' );

/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
function top_stories_menus() {

	$locations = array(
		'top-stories-primary-menu'  => esc_html__( 'Primary Menu', 'top-stories' ),
		'top-stories-social-menu'  => esc_html__( 'Social Menu', 'top-stories' ),
	);

	register_nav_menus( $locations );
}

add_action( 'init', 'top_stories_menus' );


add_filter('themeinwp_enable_demo_import_compatiblity','top_stories_demo_import_filter_apply');

if( !function_exists('top_stories_demo_import_filter_apply') ):

    function top_stories_demo_import_filter_apply(){

        return true;

    }

endif;


/**
 * Recommended Plugins
 */
require get_template_directory() . '/assets/lib/tgmpa/recommended-plugins.php';
require get_template_directory() . '/classes/class-svg-icons.php';
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/classes/class-walker-menu.php';
require get_template_directory() . '/inc/mega-menu/megamenu-custom-fields.php';
require get_template_directory() . '/assets/lib/custom/css/style.php';
require get_template_directory() . '/inc/mega-menu/walkernav.php';
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/single-related-posts.php';
require get_template_directory() . '/inc/custom-functions.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/classes/body-classes.php';
require get_template_directory() . '/inc/widgets/widgets.php';
require get_template_directory() . '/inc/metabox.php';
require get_template_directory() . '/inc/term-meta.php';
require get_template_directory() . '/inc/pagination.php';
require get_template_directory() . '/assets/lib/breadcrumbs/breadcrumbs.php';
require get_template_directory() . '/template-parts/components/main-banner.php';
require get_template_directory() . '/template-parts/components/tiles-section.php';
require get_template_directory() . '/template-parts/components/tab-section.php';
require get_template_directory() . '/template-parts/components/advertise-section.php';
require get_template_directory() . '/template-parts/components/latest-posts.php';
require get_template_directory() . '/template-parts/components/home-widget-section.php';
require get_template_directory() . '/template-parts/components/recommended-section.php';
require get_template_directory() . '/classes/admin-notice.php';
require get_template_directory() . '/classes/plugin-classes.php';
require get_template_directory() . '/classes/about.php';



if( !function_exists('top_stories_cat_selected') ):

    // Category Select on list after search
    function top_stories_cat_selected( $cat_nicename ) {

        $q_var = get_query_var( 'category' );

        if ( $q_var === $cat_nicename ) {

            return esc_attr('selected="selected"');
        }

        return false;
    }

endif;