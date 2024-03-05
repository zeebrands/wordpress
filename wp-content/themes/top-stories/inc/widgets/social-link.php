<?php
/**
 * Social Link Widgets.
 *
 * @package Top Stories
 */

if (!function_exists('top_stories_social_link_widget')) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function top_stories_social_link_widget()
    {

        // Social Link Widget.
        register_widget('Top_Stories_Social_Link_widget');

    }
endif;
add_action('widgets_init', 'top_stories_social_link_widget');


/*Social widget*/
if (!class_exists('Top_Stories_Social_Link_widget'))  :

    /**
     * Social widget Class.
     *
     * @since 1.0.0
     */
    class Top_Stories_Social_Link_widget extends Top_Stories_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'top_stories_social_widget',
                'description' => esc_html__('Displays Social share.', 'top-stories'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => esc_html__('Title:', 'top-stories'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'url-fb' => array(
                    'label' => esc_html__('Facebook URL:', 'top-stories'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-tw' => array(
                    'label' => esc_html__('Twitter URL:', 'top-stories'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-lt' => array(
                    'label' => esc_html__('Linkedin URL:', 'top-stories'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-ig' => array(
                    'label' => esc_html__('Instagram URL:', 'top-stories'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-pt' => array(
                    'label' => esc_html__('Pinterest URL:', 'top-stories'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-rt' => array(
                    'label' => esc_html__('Reddit URL:', 'top-stories'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-sk' => array(
                    'label' => esc_html__('Skype URL:', 'top-stories'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-sc' => array(
                    'label' => esc_html__('Snapchat URL:', 'top-stories'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-tr' => array(
                    'label' => esc_html__('Tumblr URL:', 'top-stories'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-th' => array(
                    'label' => esc_html__('Twitch URL:', 'top-stories'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-yt' => array(
                    'label' => esc_html__('Youtube URL:', 'top-stories'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-vo' => array(
                    'label' => esc_html__('Vimeo URL:', 'top-stories'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-wa' => array(
                    'label' => esc_html__('Whatsapp URL:', 'top-stories'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-wp' => array(
                    'label' => esc_html__('WordPress URL:', 'top-stories'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-gh' => array(
                    'label' => esc_html__('Github URL:', 'top-stories'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-fs' => array(
                    'label' => esc_html__('FourSquare URL:', 'top-stories'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-db' => array(
                    'label' => esc_html__('Dribbble URL:', 'top-stories'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-vk' => array(
                    'label' => esc_html__('VK URL:', 'top-stories'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
            );

            parent::__construct('top-stories-social-layout', esc_html__('Top Stories: Sidebar Social Widget', 'top-stories'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         * @since 1.0.0
         *
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            if (!empty($params['title'])) {
                echo $args['before_title'] . esc_html($params['title']) . $args['after_title'];
            } ?>

            <div class="theme-social-widget">
                <ul class="social-widget-list">

                    <?php if (!empty($params['url-fb'])) { ?>
                        <li class="theme-social-facebook">
                            <a href="<?php echo esc_url($params['url-fb']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php top_stories_theme_svg('facebook'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Facebook', 'top-stories'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-tw'])) { ?>
                        <li class="theme-social-twitter">
                            <a href="<?php echo esc_url($params['url-tw']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php top_stories_theme_svg('twitter'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Twitter', 'top-stories'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-lt'])) { ?>
                        <li class="theme-social-linkedin">
                            <a href="<?php echo esc_url($params['url-lt']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php top_stories_theme_svg('linkedin'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('LinkedIn', 'top-stories'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-ig'])) { ?>
                        <li class="theme-social-instagram">
                            <a href="<?php echo esc_url($params['url-ig']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php top_stories_theme_svg('instagram'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Instagram', 'top-stories'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-pt'])) { ?>
                        <li class="theme-social-pinterest">
                            <a href="<?php echo esc_url($params['url-pt']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php top_stories_theme_svg('pinterest'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Pinterest', 'top-stories'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-rt'])) { ?>
                        <li class="theme-social-reddit">
                            <a href="<?php echo esc_url($params['url-rt']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php top_stories_theme_svg('reddit'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Reddit', 'top-stories'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-sk'])) { ?>
                        <li class="theme-social-skype">
                            <a href="<?php echo esc_url($params['url-sk']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php top_stories_theme_svg('skype'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Skype', 'top-stories'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-sc'])) { ?>
                        <li class="theme-social-snapchat">
                            <a href="<?php echo esc_url($params['url-sc']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php top_stories_theme_svg('snapchat'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Snapchat', 'top-stories'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-tr'])) { ?>
                        <li class="theme-social-tumblr">
                            <a href="<?php echo esc_url($params['url-tr']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php top_stories_theme_svg('tumblr'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Tumblr', 'top-stories'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-th'])) { ?>
                        <li class="theme-social-twitch">
                            <a href="<?php echo esc_url($params['url-th']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php top_stories_theme_svg('twitch'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Twitch', 'top-stories'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-yt'])) { ?>
                        <li class="theme-social-youtube">
                            <a href="<?php echo esc_url($params['url-yt']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php top_stories_theme_svg('youtube'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Youtube', 'top-stories'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-vo'])) { ?>
                        <li class="theme-social-vimeo">
                            <a href="<?php echo esc_url($params['url-vo']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php top_stories_theme_svg('vimeo'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Vimeo', 'top-stories'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-wa'])) { ?>
                        <li class="theme-social-whatsapp">
                            <a href="<?php echo esc_url($params['url-wa']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php top_stories_theme_svg('whatsapp'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('WhatsApp', 'top-stories'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-wp'])) { ?>
                        <li class="theme-social-wordpress">
                            <a href="<?php echo esc_url($params['url-wp']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php top_stories_theme_svg('wp'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('WordPress', 'top-stories'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-gh'])) { ?>
                        <li class="theme-social-github">
                            <a href="<?php echo esc_url($params['url-gh']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php top_stories_theme_svg('github'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('GitHub', 'top-stories'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-fs'])) { ?>
                        <li class="theme-social-foursquare">
                            <a href="<?php echo esc_url($params['url-fs']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php top_stories_theme_svg('foursquare'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Foursquare', 'top-stories'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-db'])) { ?>
                        <li class="theme-social-dribbble">
                            <a href="<?php echo esc_url($params['url-db']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php top_stories_theme_svg('dribbble'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Dribbble', 'top-stories'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-vk'])) { ?>
                        <li class="theme-social-vk">
                            <a href="<?php echo esc_url($params['url-vk']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php top_stories_theme_svg('vk'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('VK', 'top-stories'); ?></span>
                            </a>
                        </li>
                    <?php } ?>

                </ul>
            </div>
            <?php echo $args['after_widget'];
        }
    }
endif;

