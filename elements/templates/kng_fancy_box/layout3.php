<?php
$text_align = techrona_get_class_breakpoints($settings, [
    'prefix' => 'text_align',
    'type-prefix' => 'text-',
]);

$widget->add_render_attribute( 'single_wrap', 'class', 'kng-fancybox d-flex relative '.implode(' ', $text_align));

 
// Heading
$widget->add_render_attribute( 'heading', 'class', 'kng-fancy-title kng-heading h4');
$widget->add_render_attribute( 'heading', 'class', 'text-'.$widget->get_setting('title_color', 'heading'));
if ( $settings['title_animation'] ) {
    $widget->add_render_attribute( 'heading', 'class', 'kng-animate kng-invisible animated-'.$settings['title_animation_duration']);
    $widget->add_render_attribute( 'heading', 'data-settings', 
        json_encode([
            'animation'      => $settings['title_animation'],
            'animation_delay' => $settings['title_animation_delay']
        ])
    );
}

// Description
$widget->add_render_attribute( 'description', 'class', 'kng-fancy-description');
$widget->add_render_attribute( 'description', 'class', 'text-'.$widget->get_setting('desc_color', 'body'));
if ( $settings['description_animation'] ) {
    $widget->add_render_attribute( 'description', 'class', 'kng-animate kng-invisible animated-'.$settings['description_animation_duration']);
    $widget->add_render_attribute( 'description', 'data-settings', 
        json_encode([
            'animation'      => $settings['description_animation'],
            'animation_delay' => $settings['description_animation_delay']
        ])
    );
}
 

if(!empty($settings['hyper_link']['url'])){
    $widget->add_render_attribute( 'fb_link', 'href', $settings['hyper_link']['url'] );

    if ( $settings['hyper_link']['is_external'] ) {
        $widget->add_render_attribute( 'fb_link', 'target', '_blank' );
    }

    if ( $settings['hyper_link']['nofollow'] ) {
        $widget->add_render_attribute( 'fb_link', 'rel', 'nofollow' );
    }

} 

$link_attributes = $widget->get_render_attribute_string( 'fb_link' );

$widget->add_render_attribute( 'icon-wrap', 'class', 'kng-fancy-icon-wrap col-auto relative kng-transition');

?>
 
<div <?php kng_print_html($widget->get_render_attribute_string('single_wrap'));?>>
    <div class="d-flex gutters-30">
        <?php if(! empty( $settings['selected_icon']['value'] ) || !empty($settings['icon_image']['id'])): ?>
            <div <?php kng_print_html($widget->get_render_attribute_string('icon-wrap'));?>><?php
                switch ($widget->get_setting('icon_type','icon')) {
                    case 'img':
                        techrona_elementor_image_render($settings,$widget,[
                            'class'       => 'kng-fancy-icon',
                            'custom_size' => '12',
                        ]);
                    break;
                    case 'icon':
                        techrona_elementor_icon_render($settings,[
                            'class'        => 'kng-transition kng-fancy-icon'
                        ]);
                    break;
                }
            ?></div>
        <?php endif; ?>
         
        <div class="kng-fancybox-content col kng-transition">
            <?php if(!empty($widget->get_setting('title'))): ?>
            <div <?php kng_print_html($widget->get_render_attribute_string( 'heading' )); ?>>
                <?php if ( $link_attributes ) echo '<a '. implode( ' ', [ $link_attributes ] ).'>'; ?>
                    <?php kng_print_html(nl2br($widget->get_setting('title'))); ?>
                <?php if ( $link_attributes ) echo '</a>'; ?>
            </div>
            <?php endif; ?>
            <?php if(!empty($widget->get_setting('description'))): ?>
            <div <?php kng_print_html($widget->get_render_attribute_string( 'description' )); ?>><?php
                kng_print_html(nl2br($widget->get_setting('description')));
            ?></div>
            <?php endif; ?>
        </div>
    </div>   
</div>
 



