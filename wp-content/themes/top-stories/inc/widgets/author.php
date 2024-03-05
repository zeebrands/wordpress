<?php
/**
 * Author Widgets.
 *
 * @package Top Stories
 */
if (!function_exists('top_stories_author_widgets')) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function top_stories_author_widgets()
    {
        // Auther widget.
        register_widget('Top_Stories_Author_widget');
    }
endif;
add_action('widgets_init', 'top_stories_author_widgets');

if (!class_exists('Top_Stories_Author_widget')) :
    /**
     * Author widget Class.
     *
     * @since 1.0.0
     */
    class Top_Stories_Author_widget extends Top_Stories_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'top_stories_author_widget',
                'description' => esc_html__('Displays authors details in post.', 'top-stories'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => esc_html__('Title:', 'top-stories'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'image_bg_url' => array(
                    'label' => esc_html__('Widget Background Image:', 'top-stories'),
                    'type' => 'image',
                ),
                'author-name' => array(
                    'label' => esc_html__('Name:', 'top-stories'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'description' => array(
                    'label' => esc_html__('Description:', 'top-stories'),
                    'type' => 'textarea',
                    'class' => 'widget-content widefat'
                ),
                'image_url' => array(
                    'label' => esc_html__('Author Image:', 'top-stories'),
                    'type' => 'image',
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
            );
            parent::__construct('top-stories-author-layout', esc_html__('Top Stories: Sidebar Author Widget', 'top-stories'), $opts, array(), $fields);
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
            <div class="author-widget-details <?php if ($params['image_bg_url']) { echo "data-bg-enable"; } ?>">
                <?php if (!empty($params['image_bg_url'])) { ?>
                    <div class="data-bg data-bg-medium" data-background="<?php echo esc_url($params['image_bg_url']); ?>">
                    </div>
                <?php } ?>
                <div class="theme-author-avatar">
                    <?php if (!empty($params['image_url'])) { ?>
                        <div class="data-bg profile-data-bg" data-background="<?php echo esc_url($params['image_url']); ?>">
                        </div>
                    <?php } ?>
                </div>
                <div class="author-content">
                    <?php if (!empty($params['author-name'])) { ?>
                        <h3 class="entry-title entry-title-small"><?php echo esc_html($params['author-name']); ?></h3>
                    <?php } ?>
                    <?php if (!empty($params['description'])) { ?>
                        <div class="author-bio"><?php echo wp_kses_post($params['description']); ?></div>
                    <?php } ?>
                </div>
                <div class="author-social-profiles">
                    <?php if (!empty($params['url-fb'])) { ?>
                        <a href="<?php echo esc_url($params['url-fb']); ?>" target="_blank" class="author-social-icon author-social-facebook">
                            <span class="btn__content" tabindex="-1">
                                <?php top_stories_theme_svg('facebook'); ?>
                            </span>
                        </a>
                    <?php } ?>
                    <?php if (!empty($params['url-tw'])) { ?>
                        <a href="<?php echo esc_url($params['url-tw']); ?>" target="_blank" class="author-social-icon author-social-twitter">
                             <span class="btn__content" tabindex="-1">
                                <?php top_stories_theme_svg('twitter'); ?>
                             </span>
                        </a>
                    <?php } ?>
                    <?php if (!empty($params['url-lt'])) { ?>
                        <a href="<?php echo esc_url($params['url-lt']); ?>" target="_blank" class="author-social-icon author-social-linkedin">
                             <span class="btn__content" tabindex="-1">
                                <?php top_stories_theme_svg('linkedin'); ?>
                             </span>
                        </a>
                    <?php } ?>
                    <?php if (!empty($params['url-ig'])) { ?>
                        <a href="<?php echo esc_url($params['url-ig']); ?>" target="_blank" class="author-social-icon author-social-instagram">
                             <span class="btn__content" tabindex="-1">
                                <?php top_stories_theme_svg('instagram'); ?>
                             </span>
                        </a>
                    <?php } ?>
                </div>
            </div>
            <?php echo $args['after_widget'];
        }
    }
endif;