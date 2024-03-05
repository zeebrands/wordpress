<?php
/**
* Sidebar Metabox.
*
* @package Top Stories
*/
 
add_action( 'add_meta_boxes', 'top_stories_metabox' );

if( ! function_exists( 'top_stories_metabox' ) ):


    function  top_stories_metabox() {
        
        add_meta_box(
            'theme-custom-metabox',
            esc_html__( 'Layout Settings', 'top-stories' ),
            'top_stories_post_metafield_callback',
            'post', 
            'normal', 
            'high'
        );
        add_meta_box(
            'theme-custom-metabox',
            esc_html__( 'Layout Settings', 'top-stories' ),
            'top_stories_post_metafield_callback',
            'page',
            'normal', 
            'high'
        ); 
    }

endif;

$top_stories_page_layout_options = array(
    'layout-1' => esc_html__( 'Simple Layout', 'top-stories' ),
    'layout-2' => esc_html__( 'Banner Layout', 'top-stories' ),
);

$top_stories_post_sidebar_fields = array(
    'global-sidebar' => array(
                    'id'        => 'post-global-sidebar',
                    'value' => 'global-sidebar',
                    'label' => esc_html__( 'Global sidebar', 'top-stories' ),
                ),
    'right-sidebar' => array(
                    'id'        => 'post-left-sidebar',
                    'value' => 'right-sidebar',
                    'label' => esc_html__( 'Right sidebar', 'top-stories' ),
                ),
    'left-sidebar' => array(
                    'id'        => 'post-right-sidebar',
                    'value'     => 'left-sidebar',
                    'label'     => esc_html__( 'Left sidebar', 'top-stories' ),
                ),
    'no-sidebar' => array(
                    'id'        => 'post-no-sidebar',
                    'value'     => 'no-sidebar',
                    'label'     => esc_html__( 'No sidebar', 'top-stories' ),
                ),
);

$top_stories_post_layout_options = array(
    'global-layout' => esc_html__( 'Global Layout', 'top-stories' ),
    'layout-1' => esc_html__( 'Simple Layout', 'top-stories' ),
    'layout-2' => esc_html__( 'Banner Layout', 'top-stories' ),
);

$top_stories_header_overlay_options = array(
    'global-layout' => esc_html__( 'Global Layout', 'top-stories' ),
    'enable-overlay' => esc_html__( 'Enable Header Overlay', 'top-stories' ),
);


/**
 * Callback function for post option.
*/
if( ! function_exists( 'top_stories_post_metafield_callback' ) ):
    
    function top_stories_post_metafield_callback() {
        global $post, $top_stories_post_sidebar_fields, $top_stories_post_layout_options,  $top_stories_page_layout_options, $top_stories_header_overlay_options;
        $post_type = get_post_type($post->ID);
        wp_nonce_field( basename( __FILE__ ), 'top_stories_post_meta_nonce' ); ?>
        
        <div class="metabox-main-block">

            <div class="metabox-navbar">
                <ul>

                    <li>
                        <a id="metabox-navbar-general" class="metabox-navbar-active" href="javascript:void(0)">

                            <?php esc_html_e('General Settings', 'top-stories'); ?>

                        </a>
                    </li>

                    <li>
                        <a id="metabox-navbar-appearance" href="javascript:void(0)">

                            <?php esc_html_e('Appearance Settings', 'top-stories'); ?>

                        </a>
                    </li>

                    <?php if( $post_type == 'post' && class_exists('Booster_Extension_Class') ): ?>
                        <li>
                            <a id="twp-tab-booster" href="javascript:void(0)">

                                <?php esc_html_e('Booster Extension Settings', 'top-stories'); ?>

                            </a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>

            <div class="twp-tab-content">

                <div id="metabox-navbar-general-content" class="metabox-content-wrap metabox-content-wrap-active">

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Sidebar Layout','top-stories'); ?></h3>

                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <?php
                            $top_stories_post_sidebar = esc_html( get_post_meta( $post->ID, 'top_stories_post_sidebar_option', true ) ); 
                            if( $top_stories_post_sidebar == '' ){ $top_stories_post_sidebar = 'global-sidebar'; }

                            foreach ( $top_stories_post_sidebar_fields as $top_stories_post_sidebar_field) { ?>

                                <label class="description">

                                    <input type="radio" name="top_stories_post_sidebar_option" value="<?php echo esc_attr( $top_stories_post_sidebar_field['value'] ); ?>" <?php if( $top_stories_post_sidebar_field['value'] == $top_stories_post_sidebar ){ echo "checked='checked'";} if( empty( $top_stories_post_sidebar ) && $top_stories_post_sidebar_field['value']=='right-sidebar' ){ echo "checked='checked'"; } ?>/>&nbsp;<?php echo esc_html( $top_stories_post_sidebar_field['label'] ); ?>

                                </label>

                            <?php } ?>

                        </div>

                    </div>

                </div>


                <div id="metabox-navbar-appearance-content" class="metabox-content-wrap">

                    <?php if( $post_type == 'page' ): ?>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Appearance Layout','top-stories'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $top_stories_page_layout = esc_html( get_post_meta( $post->ID, 'top_stories_page_layout', true ) ); 
                                if( $top_stories_page_layout == '' ){ $top_stories_page_layout = 'layout-1'; }

                                foreach ( $top_stories_page_layout_options as $key => $top_stories_page_layout_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="top_stories_page_layout" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $top_stories_page_layout ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $top_stories_page_layout_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Header Overlay','top-stories'); ?></h3>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                <?php
                                $top_stories_ed_header_overlay = esc_attr( get_post_meta( $post->ID, 'top_stories_ed_header_overlay', true ) ); ?>

                                <input type="checkbox" id="top-stories-header-overlay" name="top_stories_ed_header_overlay" value="1" <?php if( $top_stories_ed_header_overlay ){ echo "checked='checked'";} ?>/>

                                <label for="top-stories-header-overlay"><?php esc_html_e( 'Enable Header Overlay','top-stories' ); ?></label>

                            </div>

                        </div>

                    <?php endif; ?>

                    <?php if( $post_type == 'post' ): ?>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Appearance Layout','top-stories'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $top_stories_post_layout = esc_html( get_post_meta( $post->ID, 'top_stories_post_layout', true ) ); 
                                if( $top_stories_post_layout == '' ){ $top_stories_post_layout = 'global-layout'; }

                                foreach ( $top_stories_post_layout_options as $key => $top_stories_post_layout_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="top_stories_post_layout" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $top_stories_post_layout ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $top_stories_post_layout_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Header Overlay','top-stories'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $top_stories_header_overlay = esc_html( get_post_meta( $post->ID, 'top_stories_header_overlay', true ) ); 
                                if( $top_stories_header_overlay == '' ){ $top_stories_header_overlay = 'global-layout'; }

                                foreach ( $top_stories_header_overlay_options as $key => $top_stories_header_overlay_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="top_stories_header_overlay" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $top_stories_header_overlay ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $top_stories_header_overlay_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                    <?php endif; ?>

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Feature Image Setting','top-stories'); ?></h3>

                        <div class="metabox-opt-wrap theme-checkbox-wrap">

                            <?php
                            $top_stories_ed_feature_image = esc_html( get_post_meta( $post->ID, 'top_stories_ed_feature_image', true ) ); 
                            if (!isset( $_POST['top_stories_ed_feature_image'] )) {
                                $top_stories_ed_feature_image = get_theme_mod('ed_post_thumbnail');
                            }
                            ?>

                            <input type="checkbox" id="top-stories-ed-feature-image" name="top_stories_ed_feature_image" value="<?php echo $top_stories_default_feature_image; ?>" <?php if( $top_stories_ed_feature_image ){ echo "checked='checked'";} ?>/>

                            <label for="top-stories-ed-feature-image"><?php esc_html_e( 'Disable Feature Image','top-stories' ); ?></label>


                        </div>

                    </div>

                     <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Navigation Setting','top-stories'); ?></h3>

                        <?php $twp_disable_ajax_load_next_post = esc_attr( get_post_meta($post->ID, 'twp_disable_ajax_load_next_post', true) ); ?>
                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <label><b><?php esc_html_e( 'Navigation Type','top-stories' ); ?></b></label>

                            <select name="twp_disable_ajax_load_next_post">

                                <option <?php if( $twp_disable_ajax_load_next_post == '' || $twp_disable_ajax_load_next_post == 'global-layout' ){ echo 'selected'; } ?> value="global-layout"><?php esc_html_e('Global Layout','top-stories'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'no-navigation' ){ echo 'selected'; } ?> value="no-navigation"><?php esc_html_e('Disable Navigation','top-stories'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'norma-navigation' ){ echo 'selected'; } ?> value="norma-navigation"><?php esc_html_e('Next Previous Navigation','top-stories'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'ajax-next-post-load' ){ echo 'selected'; } ?> value="ajax-next-post-load"><?php esc_html_e('Ajax Load Next 3 Posts Contents','top-stories'); ?></option>

                            </select>

                        </div>
                    </div>

                </div>

                <?php if( $post_type == 'post' && class_exists('Booster_Extension_Class') ):

                    
                    $top_stories_ed_post_views = esc_html( get_post_meta( $post->ID, 'top_stories_ed_post_views', true ) );
                    $top_stories_ed_post_read_time = esc_html( get_post_meta( $post->ID, 'top_stories_ed_post_read_time', true ) );
                    $top_stories_ed_post_like_dislike = esc_html( get_post_meta( $post->ID, 'top_stories_ed_post_like_dislike', true ) );
                    $top_stories_ed_post_author_box = esc_html( get_post_meta( $post->ID, 'top_stories_ed_post_author_box', true ) );
                    $top_stories_ed_post_social_share = esc_html( get_post_meta( $post->ID, 'top_stories_ed_post_social_share', true ) );
                    $top_stories_ed_post_reaction = esc_html( get_post_meta( $post->ID, 'top_stories_ed_post_reaction', true ) );
                    $top_stories_ed_post_rating = esc_html( get_post_meta( $post->ID, 'top_stories_ed_post_rating', true ) );
                    ?>

                    <div id="twp-tab-booster-content" class="metabox-content-wrap">

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Booster Extension Plugin Content','top-stories'); ?></h3>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="top-stories-ed-post-views" name="top_stories_ed_post_views" value="1" <?php if( $top_stories_ed_post_views ){ echo "checked='checked'";} ?>/>
                                    <label for="top-stories-ed-post-views"><?php esc_html_e( 'Disable Post Views','top-stories' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="top-stories-ed-post-read-time" name="top_stories_ed_post_read_time" value="1" <?php if( $top_stories_ed_post_read_time ){ echo "checked='checked'";} ?>/>
                                    <label for="top-stories-ed-post-read-time"><?php esc_html_e( 'Disable Post Read Time','top-stories' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="top-stories-ed-post-like-dislike" name="top_stories_ed_post_like_dislike" value="1" <?php if( $top_stories_ed_post_like_dislike ){ echo "checked='checked'";} ?>/>
                                    <label for="top-stories-ed-post-like-dislike"><?php esc_html_e( 'Disable Post Like Dislike','top-stories' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="top-stories-ed-post-author-box" name="top_stories_ed_post_author_box" value="1" <?php if( $top_stories_ed_post_author_box ){ echo "checked='checked'";} ?>/>
                                    <label for="top-stories-ed-post-author-box"><?php esc_html_e( 'Disable Post Author Box','top-stories' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="top-stories-ed-post-social-share" name="top_stories_ed_post_social_share" value="1" <?php if( $top_stories_ed_post_social_share ){ echo "checked='checked'";} ?>/>
                                    <label for="top-stories-ed-post-social-share"><?php esc_html_e( 'Disable Post Social Share','top-stories' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="top-stories-ed-post-reaction" name="top_stories_ed_post_reaction" value="1" <?php if( $top_stories_ed_post_reaction ){ echo "checked='checked'";} ?>/>
                                    <label for="top-stories-ed-post-reaction"><?php esc_html_e( 'Disable Post Reaction','top-stories' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="top-stories-ed-post-rating" name="top_stories_ed_post_rating" value="1" <?php if( $top_stories_ed_post_rating ){ echo "checked='checked'";} ?>/>
                                    <label for="top-stories-ed-post-rating"><?php esc_html_e( 'Disable Post Rating','top-stories' ); ?></label>

                            </div>

                        </div>

                    </div>

                <?php endif; ?>
                
            </div>

        </div>  
            
    <?php }
endif;

// Save metabox value.
add_action( 'save_post', 'top_stories_save_post_meta' );

if( ! function_exists( 'top_stories_save_post_meta' ) ):

    function top_stories_save_post_meta( $post_id ) {

        global $post, $top_stories_post_sidebar_fields, $top_stories_post_layout_options, $top_stories_header_overlay_options,  $top_stories_page_layout_options;

        if ( !isset( $_POST[ 'top_stories_post_meta_nonce' ] ) || !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['top_stories_post_meta_nonce'] ) ), basename( __FILE__ ) ) ){

            return;

        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){

            return;

        }
            
        if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {  

            if ( !current_user_can( 'edit_page', $post_id ) ){  

                return $post_id;

            }

        }elseif( !current_user_can( 'edit_post', $post_id ) ) {

            return $post_id;

        }


        foreach ( $top_stories_post_sidebar_fields as $top_stories_post_sidebar_field ) {  
            

                $old = esc_html( get_post_meta( $post_id, 'top_stories_post_sidebar_option', true ) ); 
                $new = isset( $_POST['top_stories_post_sidebar_option'] ) ? top_stories_sanitize_sidebar_option_meta( wp_unslash( $_POST['top_stories_post_sidebar_option'] ) ) : '';

                if ( $new && $new != $old ){

                    update_post_meta ( $post_id, 'top_stories_post_sidebar_option', $new );

                }elseif( '' == $new && $old ) {

                    delete_post_meta( $post_id,'top_stories_post_sidebar_option', $old );

                }

            
        }

        $twp_disable_ajax_load_next_post_old = esc_html( get_post_meta( $post_id, 'twp_disable_ajax_load_next_post', true ) ); 
        $twp_disable_ajax_load_next_post_new = isset( $_POST['twp_disable_ajax_load_next_post'] ) ? top_stories_sanitize_meta_pagination( wp_unslash( $_POST['twp_disable_ajax_load_next_post'] ) ) : '';

        if( $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_new != $twp_disable_ajax_load_next_post_old ){

            update_post_meta ( $post_id, 'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_new );

        }elseif( '' == $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_old ) {

            delete_post_meta( $post_id,'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_old );

        }


        foreach ( $top_stories_post_layout_options as $top_stories_post_layout_option ) {  
            
            $top_stories_post_layout_old = esc_html( get_post_meta( $post_id, 'top_stories_post_layout', true ) ); 
            $top_stories_post_layout_new = isset( $_POST['top_stories_post_layout'] ) ? top_stories_sanitize_post_layout_option_meta( wp_unslash( $_POST['top_stories_post_layout'] ) ) : '';

            if ( $top_stories_post_layout_new && $top_stories_post_layout_new != $top_stories_post_layout_old ){

                update_post_meta ( $post_id, 'top_stories_post_layout', $top_stories_post_layout_new );

            }elseif( '' == $top_stories_post_layout_new && $top_stories_post_layout_old ) {

                delete_post_meta( $post_id,'top_stories_post_layout', $top_stories_post_layout_old );

            }
            
        }



        foreach ( $top_stories_header_overlay_options as $top_stories_header_overlay_option ) {  
            
            $top_stories_header_overlay_old = esc_html( get_post_meta( $post_id, 'top_stories_header_overlay', true ) ); 
            $top_stories_header_overlay_new = isset( $_POST['top_stories_header_overlay'] ) ? top_stories_sanitize_header_overlay_option_meta( wp_unslash( $_POST['top_stories_header_overlay'] ) ) : '';

            if ( $top_stories_header_overlay_new && $top_stories_header_overlay_new != $top_stories_header_overlay_old ){

                update_post_meta ( $post_id, 'top_stories_header_overlay', $top_stories_header_overlay_new );

            }elseif( '' == $top_stories_header_overlay_new && $top_stories_header_overlay_old ) {

                delete_post_meta( $post_id,'top_stories_header_overlay', $top_stories_header_overlay_old );

            }
            
        }



        $top_stories_ed_feature_image_old = esc_html( get_post_meta( $post_id, 'top_stories_ed_feature_image', true ) ); 
        $top_stories_ed_feature_image_new = isset( $_POST['top_stories_ed_feature_image'] ) ? absint( wp_unslash( $_POST['top_stories_ed_feature_image'] ) ) : '';

        if ( $top_stories_ed_feature_image_new && $top_stories_ed_feature_image_new != $top_stories_ed_feature_image_old ){

            update_post_meta ( $post_id, 'top_stories_ed_feature_image', $top_stories_ed_feature_image_new );

        }elseif( '' == $top_stories_ed_feature_image_new && $top_stories_ed_feature_image_old ) {

            delete_post_meta( $post_id,'top_stories_ed_feature_image', $top_stories_ed_feature_image_old );

        }



        $top_stories_ed_post_views_old = esc_html( get_post_meta( $post_id, 'top_stories_ed_post_views', true ) ); 
        $top_stories_ed_post_views_new = isset( $_POST['top_stories_ed_post_views'] ) ? absint( wp_unslash( $_POST['top_stories_ed_post_views'] ) ) : '';

        if ( $top_stories_ed_post_views_new && $top_stories_ed_post_views_new != $top_stories_ed_post_views_old ){

            update_post_meta ( $post_id, 'top_stories_ed_post_views', $top_stories_ed_post_views_new );

        }elseif( '' == $top_stories_ed_post_views_new && $top_stories_ed_post_views_old ) {

            delete_post_meta( $post_id,'top_stories_ed_post_views', $top_stories_ed_post_views_old );

        }



        $top_stories_ed_post_read_time_old = esc_html( get_post_meta( $post_id, 'top_stories_ed_post_read_time', true ) ); 
        $top_stories_ed_post_read_time_new = isset( $_POST['top_stories_ed_post_read_time'] ) ? absint( wp_unslash( $_POST['top_stories_ed_post_read_time'] ) ) : '';

        if ( $top_stories_ed_post_read_time_new && $top_stories_ed_post_read_time_new != $top_stories_ed_post_read_time_old ){

            update_post_meta ( $post_id, 'top_stories_ed_post_read_time', $top_stories_ed_post_read_time_new );

        }elseif( '' == $top_stories_ed_post_read_time_new && $top_stories_ed_post_read_time_old ) {

            delete_post_meta( $post_id,'top_stories_ed_post_read_time', $top_stories_ed_post_read_time_old );

        }



        $top_stories_ed_post_like_dislike_old = esc_html( get_post_meta( $post_id, 'top_stories_ed_post_like_dislike', true ) ); 
        $top_stories_ed_post_like_dislike_new = isset( $_POST['top_stories_ed_post_like_dislike'] ) ? absint( wp_unslash( $_POST['top_stories_ed_post_like_dislike'] ) ) : '';

        if ( $top_stories_ed_post_like_dislike_new && $top_stories_ed_post_like_dislike_new != $top_stories_ed_post_like_dislike_old ){

            update_post_meta ( $post_id, 'top_stories_ed_post_like_dislike', $top_stories_ed_post_like_dislike_new );

        }elseif( '' == $top_stories_ed_post_like_dislike_new && $top_stories_ed_post_like_dislike_old ) {

            delete_post_meta( $post_id,'top_stories_ed_post_like_dislike', $top_stories_ed_post_like_dislike_old );

        }



        $top_stories_ed_post_author_box_old = esc_html( get_post_meta( $post_id, 'top_stories_ed_post_author_box', true ) ); 
        $top_stories_ed_post_author_box_new = isset( $_POST['top_stories_ed_post_author_box'] ) ? absint( wp_unslash( $_POST['top_stories_ed_post_author_box'] ) ) : '';

        if ( $top_stories_ed_post_author_box_new && $top_stories_ed_post_author_box_new != $top_stories_ed_post_author_box_old ){

            update_post_meta ( $post_id, 'top_stories_ed_post_author_box', $top_stories_ed_post_author_box_new );

        }elseif( '' == $top_stories_ed_post_author_box_new && $top_stories_ed_post_author_box_old ) {

            delete_post_meta( $post_id,'top_stories_ed_post_author_box', $top_stories_ed_post_author_box_old );

        }



        $top_stories_ed_post_social_share_old = esc_html( get_post_meta( $post_id, 'top_stories_ed_post_social_share', true ) ); 
        $top_stories_ed_post_social_share_new = isset( $_POST['top_stories_ed_post_social_share'] ) ? absint( wp_unslash( $_POST['top_stories_ed_post_social_share'] ) ) : '';

        if ( $top_stories_ed_post_social_share_new && $top_stories_ed_post_social_share_new != $top_stories_ed_post_social_share_old ){

            update_post_meta ( $post_id, 'top_stories_ed_post_social_share', $top_stories_ed_post_social_share_new );

        }elseif( '' == $top_stories_ed_post_social_share_new && $top_stories_ed_post_social_share_old ) {

            delete_post_meta( $post_id,'top_stories_ed_post_social_share', $top_stories_ed_post_social_share_old );

        }



        $top_stories_ed_post_reaction_old = esc_html( get_post_meta( $post_id, 'top_stories_ed_post_reaction', true ) ); 
        $top_stories_ed_post_reaction_new = isset( $_POST['top_stories_ed_post_reaction'] ) ? absint( wp_unslash( $_POST['top_stories_ed_post_reaction'] ) ) : '';

        if ( $top_stories_ed_post_reaction_new && $top_stories_ed_post_reaction_new != $top_stories_ed_post_reaction_old ){

            update_post_meta ( $post_id, 'top_stories_ed_post_reaction', $top_stories_ed_post_reaction_new );

        }elseif( '' == $top_stories_ed_post_reaction_new && $top_stories_ed_post_reaction_old ) {

            delete_post_meta( $post_id,'top_stories_ed_post_reaction', $top_stories_ed_post_reaction_old );

        }



        $top_stories_ed_post_rating_old = esc_html( get_post_meta( $post_id, 'top_stories_ed_post_rating', true ) ); 
        $top_stories_ed_post_rating_new = isset( $_POST['top_stories_ed_post_rating'] ) ? absint( wp_unslash( $_POST['top_stories_ed_post_rating'] ) ) : '';

        if ( $top_stories_ed_post_rating_new && $top_stories_ed_post_rating_new != $top_stories_ed_post_rating_old ){

            update_post_meta ( $post_id, 'top_stories_ed_post_rating', $top_stories_ed_post_rating_new );

        }elseif( '' == $top_stories_ed_post_rating_new && $top_stories_ed_post_rating_old ) {

            delete_post_meta( $post_id,'top_stories_ed_post_rating', $top_stories_ed_post_rating_old );

        }

        foreach ( $top_stories_page_layout_options as $top_stories_post_layout_option ) {  
        
            $top_stories_page_layout_old = sanitize_text_field( get_post_meta( $post_id, 'top_stories_page_layout', true ) ); 
            $top_stories_page_layout_new = isset( $_POST['top_stories_page_layout'] ) ? top_stories_sanitize_post_layout_option_meta( wp_unslash( $_POST['top_stories_page_layout'] ) ) : '';

            if ( $top_stories_page_layout_new && $top_stories_page_layout_new != $top_stories_page_layout_old ){

                update_post_meta ( $post_id, 'top_stories_page_layout', $top_stories_page_layout_new );

            }elseif( '' == $top_stories_page_layout_new && $top_stories_page_layout_old ) {

                delete_post_meta( $post_id,'top_stories_page_layout', $top_stories_page_layout_old );

            }
            
        }

        $top_stories_ed_header_overlay_old = absint( get_post_meta( $post_id, 'top_stories_ed_header_overlay', true ) ); 
        $top_stories_ed_header_overlay_new = isset( $_POST['top_stories_ed_header_overlay'] ) ? absint( wp_unslash( $_POST['top_stories_ed_header_overlay'] ) ) : '';

        if ( $top_stories_ed_header_overlay_new && $top_stories_ed_header_overlay_new != $top_stories_ed_header_overlay_old ){

            update_post_meta ( $post_id, 'top_stories_ed_header_overlay', $top_stories_ed_header_overlay_new );

        }elseif( '' == $top_stories_ed_header_overlay_new && $top_stories_ed_header_overlay_old ) {

            delete_post_meta( $post_id,'top_stories_ed_header_overlay', $top_stories_ed_header_overlay_old );

        }

    }

endif;   