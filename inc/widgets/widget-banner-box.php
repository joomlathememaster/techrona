<?php
add_action('widgets_init', 'register_banner_box_widget');
function register_banner_box_widget() {
    if(function_exists('kng_register_wp_widget')){
        kng_register_wp_widget( 'Kng_Banner_Box' );
    }
}

class Kng_Banner_Box extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'kng_wg_bannerbox',
            esc_html__('*KNG Banner Box', 'techrona'),
            array('description' => esc_html__('Banner Box Widget', 'techrona'),)
        );
    }

    function widget($args, $instance)
    {

        extract($args);

        $wg_title = isset($instance['wg_title']) ? (!empty($instance['wg_title']) ? $instance['wg_title'] : '') : '';
        $wg_sub_title = isset($instance['wg_sub_title']) ? (!empty($instance['wg_sub_title']) ? $instance['wg_sub_title'] : '') : '';
        $wg_description = isset($instance['wg_description']) ? (!empty($instance['wg_description']) ? $instance['wg_description'] : '') : '';
        $background_img_id = isset($instance['background_img']) ? (!empty($instance['background_img']) ? $instance['background_img'] : '') : '';
        $background_img_url = wp_get_attachment_image_url($background_img_id, '');
        $wg_btn_text = isset($instance['wg_btn_text']) ? (!empty($instance['wg_btn_text']) ? $instance['wg_btn_text'] : '') : '';
        $wg_btn_link = isset($instance['wg_btn_link']) ? (!empty($instance['wg_btn_link']) ? $instance['wg_btn_link'] : '') : '';
        $layout    = $instance['layout'];
        
        printf( '%s', $args['before_widget']);
        ?>
        <div class="kng-wg-bannerbox layout-<?php echo esc_attr($layout) ?>">
            <div class="kng-wg-bannerbox-inner bg-image" <?php if(!empty($instance['background_img'])) { ?> style="background-image: url('<?php echo esc_url($background_img_url)?>');" <?php } ?>>
                <?php switch ($layout) {
                    case '2': ?>
                        <?php if (!empty($wg_sub_title)) : ?>
                            <div class="wg-sub-title"><?php echo esc_html($wg_sub_title); ?></div>
                        <?php endif; ?>
                        <?php if (!empty($wg_title)) : ?>
                            <h4 class="wg-title"><?php echo esc_html($wg_title); ?></h4>
                        <?php endif; ?>
                        <?php if (!empty($wg_description)) : ?>
                            <div class="wg-description"><?php echo esc_html($wg_description); ?></div>
                        <?php endif; ?>
                        <?php if (!empty($wg_btn_text)): ?>
                            <a class="btn btn-primary btn-hover-white text-hover-second" href="<?php echo esc_url($wg_btn_link); ?>">
                                <?php echo wp_kses_post($wg_btn_text); ?>
                                <i class="kngi-arrow-right-solid"></i>
                            </a>
                        <?php endif; ?>
                        <?php 
                        break;
                    
                    default: ?>
                        <?php if (!empty($wg_title)) : ?>
                            <h4 class="wg-title"><?php echo esc_html($wg_title); ?></h4>
                        <?php endif; ?>
                        <?php if (!empty($wg_sub_title)) : ?>
                            <div class="wg-sub-title"><?php echo esc_html($wg_sub_title); ?></div>
                        <?php endif; ?>
                        <?php if (!empty($wg_description)) : ?>
                            <div class="wg-description"><?php echo esc_html($wg_description); ?></div>
                        <?php endif; ?>
                        <?php if (!empty($wg_btn_text)): ?>
                            <a class="btn btn-primary btn-hover-white text-hover-second btn-small" href="<?php echo esc_url($wg_btn_link); ?>">
                                <?php echo wp_kses_post($wg_btn_text); ?>
                            </a>
                        <?php endif; 

                        break; 
                } ?>
                
            </div>
        </div>
        <?php
        printf('%s', $args['after_widget']);
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['wg_title']       = strip_tags($new_instance['wg_title']);
        $instance['wg_sub_title']   = strip_tags($new_instance['wg_sub_title']);
        $instance['wg_description'] = strip_tags($new_instance['wg_description']);
        $instance['wg_btn_text']    = strip_tags($new_instance['wg_btn_text']);
        $instance['wg_btn_link']    = strip_tags($new_instance['wg_btn_link']);
        $instance['background_img'] = strip_tags($new_instance['background_img']);
        $instance['layout']         = $new_instance['layout'];
        return $instance;
    }

    function form($instance)
    {
        $wg_title       = isset($instance['wg_title']) ? esc_attr($instance['wg_title']) : '';
        $wg_sub_title   = isset($instance['wg_sub_title']) ? esc_attr($instance['wg_sub_title']) : '';
        $wg_description = isset($instance['wg_description']) ? esc_attr($instance['wg_description']) : '';
        $wg_btn_text    = isset($instance['wg_btn_text']) ? esc_attr($instance['wg_btn_text']) : '';
        $wg_btn_link    = isset($instance['wg_btn_link']) ? esc_attr($instance['wg_btn_link']) : '';
        $background_img = isset($instance['background_img']) ? esc_attr($instance['background_img']) : '';
        $layout         = isset($instance['layout']) ? esc_attr($instance['layout']) : '1';
        ?>

        <div class="kng-wg-image-wrap" style="margin-top: 15px;">
            <label style="margin-top: 4px;" for="<?php echo esc_url($this->get_field_id('background_img')); ?>"><?php esc_html_e('Box Background Image', 'techrona'); ?></label>
            <input type="hidden" class="widefat hide-image-url"
                   id="<?php echo esc_attr($this->get_field_id('background_img')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('background_img')); ?>"
                   value="<?php echo esc_attr($background_img) ?>"/>
            <div class="kng-wg-show-image">
                <?php
                if ($background_img != "") {
                    ?>
                    <img style="max-width: 110px;" src="<?php echo wp_get_attachment_image_url($background_img) ?>">
                    <?php
                }
                ?>
            </div>
            <?php
            if ($background_img != "") {
                ?>
                <a href="#" class="kng-wg-select-image button" style="display: none;"><?php esc_html_e('Select Image', 'techrona'); ?></a>
                <a href="#" class="kng-wg-remove-image button"><?php esc_html_e('Remove Image', 'techrona'); ?></a>
                <?php
            } else {
                ?>
                <a href="#" class="kng-wg-select-image button"><?php esc_html_e('Select Image', 'techrona'); ?></a>
                <a href="#" class="kng-wg-remove-image button" style="display: none;"><?php esc_html_e('Remove Image', 'techrona'); ?></a>
                <?php
            }
            ?>
        </div>
        
        <p>
            <label for="<?php echo esc_url($this->get_field_id('wg_title')); ?>"><?php esc_html_e('Title', 'techrona'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('wg_title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('wg_title')); ?>" type="text"
                   value="<?php echo esc_attr($wg_title); ?>"/></p>
        <p>
            <label for="<?php echo esc_url($this->get_field_id('wg_sub_title')); ?>"><?php esc_html_e('Sub Title', 'techrona'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('wg_sub_title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('wg_sub_title')); ?>" type="text"
                   value="<?php echo esc_attr($wg_sub_title); ?>"/></p>
        <p>
            <label for="<?php echo esc_url($this->get_field_id('wg_description')); ?>"><?php esc_html_e('Description', 'techrona'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('wg_description')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('wg_description')); ?>" type="text"
                   value="<?php echo esc_attr($wg_description); ?>"/></p>

        <p>
            <label for="<?php echo esc_url($this->get_field_id('wg_btn_text')); ?>"><?php esc_html_e('Button Text', 'techrona'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('wg_btn_text')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('wg_btn_text')); ?>" type="text"
                   value="<?php echo esc_attr($wg_btn_text); ?>"/></p>

        <p>
            <label for="<?php echo esc_url($this->get_field_id('wg_btn_link')); ?>"><?php esc_html_e('Button Link', 'techrona'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('wg_btn_link')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('wg_btn_link')); ?>" type="text"
                   value="<?php echo esc_attr($wg_btn_link); ?>"/></p>
        <p>
            <label for="<?php echo esc_url($this->get_field_id('layout')); ?>"><?php esc_html_e( 'Layout', 'techrona' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id('layout') ); ?>" name="<?php echo esc_attr( $this->get_field_name('layout') ); ?>">
                <option value="1"<?php if( $layout == '1' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Default', 'techrona'); ?></option>
                <option value="2"<?php if( $layout == '2' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Layout 2', 'techrona'); ?></option>
            </select></p>

        <?php
    }

}

 