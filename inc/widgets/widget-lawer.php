<?php

add_action('widgets_init', 'register_lawer_widget');
function register_lawer_widget() {
    if(function_exists('kng_register_wp_widget')){
        kng_register_wp_widget( 'Kng_lawer' );
    }
}

class Kng_lawer extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'kng_wg_lawer',
            esc_html__('*KNG Lawer', 'techrona'),
            array('description' => esc_html__('Lawer Box Information', 'techrona'),)
        );
    }

    function widget($args, $instance)
    {

        extract($args);
 
        $wg_title      = !empty($instance['wg_title']) ? $instance['wg_title'] : '';
        $desc          = !empty($instance['desc']) ? $instance['desc'] : '';
        $name          = !empty($instance['name']) ? $instance['name'] : '';
        $lawer_role    = !empty($instance['lawer_role']) ? $instance['lawer_role'] : '';
        $lawer_img_id  = !empty($instance['lawer_img']) ? $instance['lawer_img'] : '';
        $lawer_img_url = wp_get_attachment_image_url($lawer_img_id, '');
        $link          = !empty($instance['link']) ? $instance['link'] : '';

        $social1       = !empty($instance['social1']) ? $instance['social1'] : '';
        $social2       = !empty($instance['social2']) ? $instance['social2'] : '';
        $social3       = !empty($instance['social3']) ? $instance['social3'] : '';
        $social4       = !empty($instance['social4']) ? $instance['social4'] : '';
        $social5       = !empty($instance['social5']) ? $instance['social5'] : '';
          
        printf( '%s', $args['before_widget']);
        if(!empty($wg_title)){
            printf( '%s %s %s', $args['before_title'] , $wg_title , $args['after_title']);
        }

        $link_before = $link_after = '';
        if( !empty($link) ){
            $link_before = '<a href="'.esc_url($link).'">';
            $link_after  = '</a>';
        }
        ?>
        <div class="kng-wg-lawer text-center">
            <div class="kng-wg-lawer-inner">
                <?php 
                if(!empty($lawer_img_url)){ 

                    echo '<div class="lawer-img round">'.$link_before.'<img src="'.esc_url($lawer_img_url).'">'.$link_after.'</div>';
                }
                if (!empty($desc))
                    echo '<div class="desc">'.$desc.'</div>';
                if (!empty($name))
                    echo '<div class="name h5">'.$link_before.$name.$link_after.'</div>';
                if (!empty($lawer_role))
                    echo '<div class="lawer-role">'.$lawer_role.'</div>';
                ?>
            </div>
            <div class="lawer-social d-flex justify-content-center">
                <?php 
                    if(!empty($social1)){
                        $social1s = explode('|', $social1); 
                        echo '<a href="'.esc_url($social1s[1]).'"><span class="'.$social1s[0].'"></span></a>';
                    }
                    if(!empty($social2)){
                        $social2s = explode('|', $social2); 
                        echo '<a href="'.esc_url($social2s[1]).'"><span class="'.$social2s[0].'"></span></a>';
                    }
                    if(!empty($social3)){
                        $social3s = explode('|', $social3); 
                        echo '<a href="'.esc_url($social3s[1]).'"><span class="'.$social3s[0].'"></span></a>';
                    }
                    if(!empty($social4)){
                        $social4s = explode('|', $social4); 
                        echo '<a href="'.esc_url($social4s[1]).'"><span class="'.$social4s[0].'"></span></a>';
                    }
                    if(!empty($social5)){
                        $social5s = explode('|', $social5); 
                        echo '<a href="'.esc_url($social5s[1]).'"><span class="'.$social5s[0].'"></span></a>';
                    }
                ?>
            </div>
        </div>
        <?php
        printf('%s', $args['after_widget']);
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['wg_title']       = strip_tags($new_instance['wg_title']);
        $instance['desc']   = strip_tags($new_instance['desc']);
        $instance['name'] = strip_tags($new_instance['name']);
        $instance['lawer_role']    = strip_tags($new_instance['lawer_role']);
        $instance['link']    = strip_tags($new_instance['link']);
        $instance['lawer_img'] = strip_tags($new_instance['lawer_img']);

        $instance['social1'] = strip_tags($new_instance['social1']);
        $instance['social2'] = strip_tags($new_instance['social2']);
        $instance['social3'] = strip_tags($new_instance['social3']);
        $instance['social4'] = strip_tags($new_instance['social4']);
        $instance['social5'] = strip_tags($new_instance['social5']);

        return $instance;
    }

    function form($instance)
    {
        $wg_title   = isset($instance['wg_title']) ? esc_attr($instance['wg_title']) : '';
        $desc       = isset($instance['desc']) ? esc_attr($instance['desc']) : '';
        $name       = isset($instance['name']) ? esc_attr($instance['name']) : '';
        $lawer_role = isset($instance['lawer_role']) ? esc_attr($instance['lawer_role']) : '';
        $link       = isset($instance['link']) ? esc_attr($instance['link']) : '';
        $lawer_img  = isset($instance['lawer_img']) ? esc_attr($instance['lawer_img']) : '';

        $social1  = isset($instance['social1']) ? esc_attr($instance['social1']) : '';
        $social2  = isset($instance['social2']) ? esc_attr($instance['social2']) : '';
        $social3  = isset($instance['social3']) ? esc_attr($instance['social3']) : '';
        $social4  = isset($instance['social4']) ? esc_attr($instance['social4']) : '';
        $social5  = isset($instance['social5']) ? esc_attr($instance['social5']) : '';
        ?>

        <div class="kng-wg-image-wrap" style="margin-top: 15px;">
            <label style="margin-top: 4px;" for="<?php echo esc_url($this->get_field_id('lawer_img')); ?>"><?php esc_html_e('Lawer Image', 'techrona'); ?></label>
            <input type="hidden" class="widefat hide-image-url"
                   id="<?php echo esc_attr($this->get_field_id('lawer_img')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('lawer_img')); ?>"
                   value="<?php echo esc_attr($lawer_img) ?>"/>
            <div class="kng-wg-show-image">
                <?php
                if ($lawer_img != "") {
                    ?>
                    <img style="max-width: 110px;" src="<?php echo wp_get_attachment_image_url($lawer_img) ?>">
                    <?php
                }
                ?>
            </div>
            <?php
            if ($lawer_img != "") {
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
            <label for="<?php echo esc_url($this->get_field_id('desc')); ?>"><?php esc_html_e('Description', 'techrona'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('desc')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('desc')); ?>"><?php echo esc_attr($desc); ?></textarea></p>
        <p>
            <label for="<?php echo esc_url($this->get_field_id('name')); ?>"><?php esc_html_e('Name', 'techrona'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('name')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('name')); ?>" type="text"
                   value="<?php echo esc_attr($name); ?>"/></p>

        <p>
            <label for="<?php echo esc_url($this->get_field_id('lawer_role')); ?>"><?php esc_html_e('Lawer Role', 'techrona'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('lawer_role')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('lawer_role')); ?>" type="text"
                   value="<?php echo esc_attr($lawer_role); ?>"/></p>

        <p>
            <label for="<?php echo esc_url($this->get_field_id('link')); ?>"><?php esc_html_e('Link', 'techrona'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('link')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('link')); ?>" type="text"
                   value="<?php echo esc_attr($link); ?>"/></p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('social1')); ?>"><?php esc_html_e( 'Social 1: (icon class | icon link)', 'techrona' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('social1') ); ?>" name="<?php echo esc_attr( $this->get_field_name('social1') ); ?>" type="text" value="<?php echo esc_attr( $social1 ); ?>" /></p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('social2')); ?>"><?php esc_html_e( 'Social 2: (icon class | icon link)', 'techrona' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('social2') ); ?>" name="<?php echo esc_attr( $this->get_field_name('social2') ); ?>" type="text" value="<?php echo esc_attr( $social2 ); ?>" /></p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('social3')); ?>"><?php esc_html_e( 'Social 3: (icon class | icon link)', 'techrona' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('social3') ); ?>" name="<?php echo esc_attr( $this->get_field_name('social3') ); ?>" type="text" value="<?php echo esc_attr( $social3 ); ?>" /></p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('social4')); ?>"><?php esc_html_e( 'Social 4: (icon class | icon link)', 'techrona' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('social4') ); ?>" name="<?php echo esc_attr( $this->get_field_name('social4') ); ?>" type="text" value="<?php echo esc_attr( $social4 ); ?>" /></p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('social5')); ?>"><?php esc_html_e( 'Social 5: (icon class | icon link)', 'techrona' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('social5') ); ?>" name="<?php echo esc_attr( $this->get_field_name('social5') ); ?>" type="text" value="<?php echo esc_attr( $social5 ); ?>" /></p>

        <?php
    }
}

 