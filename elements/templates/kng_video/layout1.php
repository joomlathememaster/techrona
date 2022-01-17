<?php
$img_classes = [];
// wrap
$widget->add_render_attribute( 'wrap', 'class', 'kng-video-player relative kng-video-play-btn-center-center');
// Gradient
$widget->add_render_attribute( 'gradient', 'class', 'kng-overlay kng-gradient-'.$widget->get_setting('gradient_overlay', ''));
$widget->add_render_attribute( 'gradient', 'style', 'background-color:'.$widget->get_setting('gradient_bg_color','rgba(9,29,62,0.05)'));
// Play Icon
$widget->add_render_attribute( 'play-icon', 'class', 'kng-play-video-icon '.$widget->get_setting('gradient_overlay', ''));
// Video Link 
$video_play_icon = $widget->get_setting('play_icon_icon', ''); 
?>
<div <?php kng_print_html($widget->get_render_attribute_string( 'wrap' )); ?>>
    <div class="relative">
        <?php 
            techrona_elementor_image_render($settings,$widget, [
                'id'          => 'video_image_overlay',
                'size'        => 'video_image_overlay_size',
                'img_class'       => 'video-bg rtl-flip kng-radius-8'.implode(' ', $img_classes)
            ]);
        ?>
        <div class="kng-overlay"></div>
        <div class="btn-video-wrap">
            <?php techrona_elementor_render_lightbox_video_button($widget, $settings,[
                'icon_class' => 'size-85 text-center square'
            ]); ?>
        </div>
    </div>
     
</div>