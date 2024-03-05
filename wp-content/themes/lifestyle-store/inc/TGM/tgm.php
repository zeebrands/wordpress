<?php
	
load_template( get_template_directory() . '/inc/TGM/class-tgm-plugin-activation.php' );

/**
 * Recommended plugins.
 */
function lifestyle_store_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'WooCommerce', 'lifestyle-store' ),
			'slug'             => 'woocommerce',
			'required'         => false,
			'force_activation' => false,
		),
	);
	$config = array();
	lifestyle_store_tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'lifestyle_store_register_recommended_plugins' );