<?php
$color_mode = $widget->get_setting('color_mode', '');
$text_align = techrona_get_class_breakpoints($settings, [
    'prefix' => 'text_align',
    'type-prefix' => 'text-',
]);
$justify_align = techrona_get_class_breakpoints($settings, [
    'prefix' => 'text_align',
    'type-prefix' => 'justify-content-',
]);

$widget->add_render_attribute('wrap', ['class' => 'kng-ttmn-wrapper relative '.trim(implode(' ', $text_align)).' layout-'.$settings['layout'].' '.$color_mode]);
// Testinominal Text
$widget->add_render_attribute( 'description', 'class', 'kng-ttmn-desc kng-heading text-30 font-400');

// Author
$widget->add_render_attribute( 'author', 'class', 'kng-ttmn-author-name kng-heading text-24 font-700');
// Positon
$widget->add_render_attribute( 'position', 'class', 'kng-ttmn-author-position text-17 font-500');

 
$args = [
    'slide_to_show_widescreen'   => $widget->get_setting('slide_to_show_widescreen', '1'),
    'slide_to_show'              => $widget->get_setting('slide_to_show', '1'),
    'slide_to_show_laptop'       => $widget->get_setting('slide_to_show_laptop', '1'),
    'slide_to_show_tablet_extra' => $widget->get_setting('slide_to_show_tablet_extra', '1'),
    'slide_to_show_tablet'       => $widget->get_setting('slide_to_show_tablet', '1'),
    'slide_to_show_mobile_extra' => $widget->get_setting('slide_to_show_mobile_extra', '1'),
    'slide_to_show_mobile'       => $widget->get_setting('slide_to_show_mobile', '1'),
];
$dots_arg = ['class' => trim(implode(' ', $justify_align))];
?>
<div <?php kng_print_html($widget->get_render_attribute_string( 'wrap' ));?>>
    <div class="kng-ttmn-slider">
        <?php techrona_swiper_slider_arrows_top($settings); ?>
        <div class="kng-swiper-inner overflow-hidden relative">
            <span class="testi-icon"><?php \Elementor\Icons_Manager::render_icon( $settings['quote_icon'], [ 'aria-hidden' => 'true' ] );?></span>
            <div <?php techrona_swiper_slider_settings($widget,$args) ?>>
                <div class="kng-swiper-wrapper swiper-wrapper">
                    <?php foreach ($settings['testimonial'] as $value): ?>
                        <div class="kng-ttmn-item kng-swiper-slide swiper-slide">
                            <div <?php kng_print_html($widget->get_render_attribute_string( 'description' )) ?>><?php 
                                echo esc_html($value['description']); 
                            ?></div>
                            <div class="row gutters-20 <?php echo esc_attr(trim(implode(' ', $justify_align))) ?>">
                                <?php if(!empty($value['author_img']['url'])): ?>
                                <div class="col-auto empty-none">
                                    <img class="author-avt" src="<?php echo esc_url($value['author_img']['url']); ?>" alt="<?php echo esc_html($value['author'])?>">
                                </div>
                                <?php endif; ?>
                                <div class="col-auto text-start">
                                    <div <?php kng_print_html($widget->get_render_attribute_string( 'author' )) ?>><?php 
                                        echo esc_html($value['author']); 
                                    ?></div>
                                    <div <?php kng_print_html($widget->get_render_attribute_string( 'position' )) ?>><?php 
                                        echo esc_html($value['position']); 
                                    ?></div>
                                </div>
                            </div>
                            
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php 
            techrona_swiper_slider_dots($settings,$dots_arg); 
            techrona_swiper_slider_arrows($settings);
            techrona_swiper_slider_arrows_side($settings);
            techrona_swiper_slider_arrows_bottom($settings);
        ?>
    </div>
</div>
