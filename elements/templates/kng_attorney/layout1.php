<?php
 
if(!empty($settings['hyper_link']['url'])){
    $widget->add_render_attribute( 'attorney_link', 'href', $settings['hyper_link']['url'] );

    if ( $settings['hyper_link']['is_external'] ) {
        $widget->add_render_attribute( 'attorney_link', 'target', '_blank' );
    }

    if ( $settings['hyper_link']['nofollow'] ) {
        $widget->add_render_attribute( 'attorney_link', 'rel', 'nofollow' );
    }

} 

$link_attributes = $widget->get_render_attribute_string( 'attorney_link' );

?>
 
<div class="kng-attorney-wrap layout-<?php echo esc_attr($widget->get_setting('layout')) ?>">
    <div class="attorney-img">
        <?php if( !empty( $settings['selected_img']['id']) ):  
            techrona_elementor_image_render($settings,$widget,[
                'attachment_id' => $settings['selected_img']['id'],
                'class'         => 'kng-fancy-icon',
                //'size'          => $settings['img_size']
            ]); 
            elseif(!empty($settings['selected_img']['url'])): ?>
                <img src="<?php echo esc_url($settings['selected_img']['url'])?>" alt="Attorney">
            <?php endif; ?>
            <div class="kng-overlay">
                <div class="kng-socials row gutters-10 justify-content-center align-items-center">
                <?php 
                if(!empty($settings['social_list'])){
                    foreach ($settings['social_list'] as $value):
                        $link_attrs = [];
                        if ( ! empty( $value['social_link']['url'] ) ) {
                            $link_attrs['href'] = $value['social_link']['url'];
                        }
                        if ( ! empty($value['social_link']['is_external'] )) {
                            $link_attrs['target'] = '_blank';
                        }
                        if ( ! empty($value['social_link']['nofollow'] )) {
                            $link_attrs['rel'] = 'nofollow';
                        }
                        if( ! empty($value['social_link']['custom_attributes'])){
                            $custom_attributes = explode('|', $value['social_link']['custom_attributes']);
                            foreach ($custom_attributes as $atts_value) {
                                $_custom_attributes = explode(':', $atts_value);
                                $link_attrs[$_custom_attributes[0]] = $_custom_attributes[1];
                            }
                        }
                        ?>
                        <div class="kng-social kng-social-item col-auto">
                        <?php 
                            techrona_elementor_icon_render($settings,
                                [
                                    'tag'        => 'a',        
                                    'id'         => $value['social_icon'],
                                    'loop'       => true,
                                    'wrap_class' => 'text-center',
                                    'class'      => '',
                                    'atts'       => $link_attrs
                                ]
                            );
                        ?>
                        </div>  
                    <?php endforeach; 
                }
                ?>  
                </div> 
            </div>
    </div>
     
    <div class="attorney-content kng-transition">
        <?php if(!empty($widget->get_setting('attorney_name'))): ?>
        <div class="attorney-name h4">
            <?php if ( $link_attributes ) echo '<a '. implode( ' ', [ $link_attributes ] ).'>'; ?>
                <?php kng_print_html($widget->get_setting('attorney_name')); ?>
            <?php if ( $link_attributes ) echo '</a>'; ?>
        </div>
        <?php endif; ?>
        <?php if(!empty($widget->get_setting('attorney_position'))): ?>
        <div class="position"><?php
            kng_print_html($widget->get_setting('attorney_position'));
        ?></div>
        <?php endif; ?>
    </div>
     
</div>
 



