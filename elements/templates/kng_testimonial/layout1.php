<?php
$text_align = techrona_get_class_breakpoints($settings, [
    'prefix' => 'text_align',
    'type-prefix' => 'text-',
]);

$widget->add_render_attribute('wrap', ['class' => 'kng-ttmn-wrapper relative '.trim(implode(' ', $text_align)).' layout-'.$settings['layout']]);

// Testinominal Text
$widget->add_render_attribute( 'description', 'class', 'kng-ttmn-desc kng-heading text-30 text-center font-400');
// Author
$widget->add_render_attribute( 'author', 'class', 'kng-ttmn-author-name kng-heading text-24 font-700');
// Positon
$widget->add_render_attribute( 'position', 'class', 'kng-ttmn-author-position text-17 font-500');

$widget->add_render_attribute( 'avatar_1', 'class', 'static-img avatar-corner1 absolute d-none d-lg-block');
$widget->add_render_attribute( 'avatar_2', 'class', 'static-img avatar-corner2 absolute d-none d-lg-block');
$widget->add_render_attribute( 'avatar_3', 'class', 'static-img avatar-corner3 absolute d-none d-lg-block');
$widget->add_render_attribute( 'avatar_4', 'class', 'static-img avatar-corner4 absolute d-none d-lg-block');

if(!empty($settings['avatar_img_1']['url'])) {
    $widget->add_render_attribute( 'avatar_1', 'class', 'kng-animate kng-invisible animated-100');
    $widget->add_render_attribute( 'avatar_1', 'data-settings', 
        json_encode([
            'animation'      => 'zoomIn',
            'animation_delay' => '100'
        ])
    );
}
if(!empty($settings['avatar_img_2']['url'])) {
    $widget->add_render_attribute( 'avatar_2', 'class', 'kng-animate kng-invisible animated-200');
    $widget->add_render_attribute( 'avatar_2', 'data-settings', 
        json_encode([
            'animation'      => 'zoomIn',
            'animation_delay' => '200'
        ])
    );
}
if(!empty($settings['avatar_img_3']['url'])) {
    $widget->add_render_attribute( 'avatar_3', 'class', 'kng-animate kng-invisible animated-300');
    $widget->add_render_attribute( 'avatar_3', 'data-settings', 
        json_encode([
            'animation'      => 'zoomIn',
            'animation_delay' => '300'
        ])
    );
}
if(!empty($settings['avatar_img_4']['url'])) {
    $widget->add_render_attribute( 'avatar_4', 'class', 'kng-animate kng-invisible animated-400');
    $widget->add_render_attribute( 'avatar_4', 'data-settings', 
        json_encode([
            'animation'      => 'zoomIn',
            'animation_delay' => '400'
        ])
    );
}

?>
<div <?php kng_print_html($widget->get_render_attribute_string( 'wrap' ));?>>
    <?php 
        techrona_elementor_image_render($settings,$widget, [
            'id'     => 'avatar_img_1',
            'size'   => 'full',
            'before' => '<div '.$widget->get_render_attribute_string( 'avatar_1' ).'>',
            'after'  => '</div>'
        ]);
        techrona_elementor_image_render($settings,$widget, [
            'id'     => 'avatar_img_2',
            'size'   => 'full',
            'before' => '<div '.$widget->get_render_attribute_string( 'avatar_2' ).'>',
            'after'  => '</div>'
        ]);
        techrona_elementor_image_render($settings,$widget, [
            'id'     => 'avatar_img_3',
            'size'   => 'full',
            'before' => '<div '.$widget->get_render_attribute_string( 'avatar_3' ).'>',
            'after'  => '</div>'
        ]);
        techrona_elementor_image_render($settings,$widget, [
            'id'     => 'avatar_img_4',
            'size'   => 'full',
            'before' => '<div '.$widget->get_render_attribute_string( 'avatar_4' ).'>',
            'after'  => '</div>'
        ]);
    ?>
    <div class="kng-ttmn-slider row justify-content-center">
        <div class="kng-swiper-slider-wrap col-lg-8">
            <?php techrona_swiper_slider_arrows_top($settings); ?>
            <div class="kng-swiper-outer">
                <div class="kng-swiper-inner overflow-hidden">
                    <div <?php techrona_swiper_slider_settings($widget); ?>>
                        <div class="kng-swiper-wrapper swiper-wrapper">
                            <?php foreach ($settings['testimonial'] as $value): ?>
                                <div class="kng-ttmn-item kng-swiper-slide swiper-slide">
                                    <div <?php kng_print_html($widget->get_render_attribute_string( 'description' )); ?>><?php 
                                        echo esc_html($value['description']); 
                                    ?></div>
                                    <div class="row gutters-20 justify-content-center">
                                        <?php if(!empty($value['author_img']['url'])): ?>
                                        <div class="col-auto empty-none">
                                            <img class="author-avt" src="<?php echo esc_url($value['author_img']['url']); ?>" alt="<?php echo esc_html($value['author'])?>">
                                        </div>
                                        <?php endif; ?>
                                        <div class="col-auto">
                                            <div <?php kng_print_html($widget->get_render_attribute_string( 'author' )); ?>><?php 
                                                echo esc_html($value['author']); 
                                            ?></div>
                                            <div <?php kng_print_html($widget->get_render_attribute_string( 'position' )); ?>><?php 
                                                echo esc_html($value['position']); 
                                            ?></div>
                                        </div>
                                    </div>
                                    <span class="testi-icon">
                                        <?php 
                                            \Elementor\Icons_Manager::render_icon( $settings['quote_icon'], [ 'aria-hidden' => 'true' ] );
                                        ?>
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                techrona_swiper_slider_dots($settings); 
                techrona_swiper_slider_arrows($settings);
                techrona_swiper_slider_arrows_side($settings);
                techrona_swiper_slider_arrows_bottom($settings);
            ?>
        </div>
    </div>
</div>
