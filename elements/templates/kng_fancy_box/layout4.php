<?php
// Single 
// @type-prefix: justify-content-, text-,align-self-
$text_align = techrona_get_class_breakpoints($settings, [
    'prefix' => 'text_align',
    'type-prefix' => 'text-',
]);

$widget->add_render_attribute( 'single_wrap', 'class', 'kng-fancybox relative '.trim( implode(' ', $text_align)));

// Single Inner
$widget->add_render_attribute('single-wrap-inner', 'class' , 'kng-fancybox-inner relative kng-transition');

// sub title
$widget->add_render_attribute( 'sub-heading', 'class', 'kng-fancy-sub-title text-22 font-700');
$widget->add_render_attribute( 'sub-heading', 'class', 'text-'.$widget->get_setting('sub_title_color', 'primary'));
if ( $settings['title_animation'] ) {
    $widget->add_render_attribute( 'sub-heading', 'class', 'kng-animate kng-invisible animated-'.$settings['sub_title_animation_duration']);
    $widget->add_render_attribute( 'sub-heading', 'data-settings', 
        json_encode([
            'animation'      => $settings['sub_title_animation'],
            'animation_delay' => $settings['sub_title_animation_delay']
        ])
    );
}

// Heading
$widget->add_render_attribute( 'heading', 'class', 'kng-fancy-title kng-heading h2 font-700');
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

$bg_img_overlay = $widget->get_setting('bg_img_overlay');
$bg_style = !empty($bg_img_overlay['url']) ? 'style="background-image:url('.esc_url($bg_img_overlay['url']).');"' : '';
 
?>
 
<div <?php kng_print_html($widget->get_render_attribute_string('single_wrap'));?>>
    <div class="kng-overlay bg-cover kng-transition" <?php kng_print_html($bg_style) ?>></div>
    <div <?php kng_print_html($widget->get_render_attribute_string('single-wrap-inner'));?>>
        <div class="kng-fancybox-content">
            <?php if(!empty($widget->get_setting('sub_title'))): ?>
            <div <?php kng_print_html($widget->get_render_attribute_string( 'sub-heading' )); ?>><?php
                kng_print_html($widget->get_setting('sub_title'));
            ?></div>
            <?php endif; ?>
            <?php if(!empty($widget->get_setting('title'))): ?>
            <div <?php kng_print_html($widget->get_render_attribute_string( 'heading' )); ?>><?php
                kng_print_html(nl2br($widget->get_setting('title')));
            ?></div>
            <?php endif; ?>
            <?php if(!empty($widget->get_setting('description'))): ?>
            <div <?php kng_print_html($widget->get_render_attribute_string( 'description' )); ?>><?php
                kng_print_html(nl2br($widget->get_setting('description')));
            ?></div>
            <?php endif; ?>
            <?php if(!empty($settings['hyper_link']['url']) && !empty($settings['link_text'])): ?>
                <a href="<?php echo esc_url($settings['hyper_link']['url']) ?>" class="btn">
                    <span class="kng-btn-content kng-btn-content-">
                        <span class="kng-btn-text"><?php echo esc_html($settings['link_text']) ?></span>
                            <span class="kng-btn-icon kng-align-icon-right  rtl-flip"> <i aria-hidden="true" class="kngi kngi-arrow-right-solid"></i> </span>
                    </span>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
 



