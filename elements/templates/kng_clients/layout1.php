<?php
 
?>
 
<div class="kng-client-slider kng-swiper-sliders">
    <div class="kng-swiper-slider-wrap">
        <div <?php techrona_swiper_slider_settings($widget, ['class' => 'no-shadow']); ?>>
            <?php techrona_swiper_slider_arrows_top($settings); ?>
            <div class="kng-swiper-wrapper swiper-wrapper align-items-center">
                <?php foreach ($settings['clients'] as $value): ?>
                    <div class="kng-client-item kng-swiper-slide swiper-slide">
                        <a <?php echo techrona_elementor_custom_link_attrs($value, [
                            'name' => 'image_link',
                            'echo' => true,
                            'class' => 'd-block text-center'
                        ]);?>>
                            <?php
                                techrona_elementor_image_render($settings, $widget, [
                                    'id'            => 'selected_img',
                                    'attachment_id' => $value['selected_img']['id']
                                ], $value);
                            ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php 
                techrona_swiper_slider_dots($settings); 
                techrona_swiper_slider_arrows($settings);
                techrona_swiper_slider_arrows_bottom($settings);
                techrona_swiper_slider_arrows_side($settings);
            ?>
        </div>
    </div>
</div>