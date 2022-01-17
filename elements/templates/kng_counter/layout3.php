<?php
// Wrap
$text_align = techrona_get_class_breakpoints($settings, [
    'prefix' => 'text_align',
    'type-prefix' => 'text-',
]);
$widget->add_render_attribute('wrap', [
    'class' => 'kng-counter-wrap '.trim(implode(' ', $text_align)).' layout-'.$settings['layout']
]);
// Counter Number
$widget->add_render_attribute( 'counter', [
    'class' => 'kng-counter-number-wrap text-'.$widget->get_setting('number_color','')
] );
$widget->add_render_attribute( 'counter-number', [
    'class'          => 'kng-counter-number',
    'data-duration'  => $widget->get_setting('duration', '300'),
    'data-to-value'  => $widget->get_setting('ending_number', '97'),
    'data-delimiter' => $widget->get_setting('thousand_separator_char', ',' ),
] );
// Title
$widget->add_render_attribute( 'title', [
    'class' => 'kng-counter-title text-'.$widget->get_setting('title_color','')
] );
if ( $settings['title_animation'] ) {
    $widget->add_render_attribute( 'title', 'class', 'elementor-invisible');
    $widget->add_render_attribute( 'title', 'class', 'animated-'.$widget->get_setting('title_animation_duration', ''));
    $widget->add_render_attribute( 'title', 'data-settings', json_encode([
        '_animation'      => $widget->get_setting('title_animation', ''),
        'animation_delay' => $widget->get_setting('title_animation_delay', '')
    ]));
}
// Description 
$widget->add_render_attribute( 'description', [
    'class' => 'kng-counter-desc text-'.$widget->get_setting('description','')
] );
if ( $settings['description_animation'] ) {
    $widget->add_render_attribute( 'description', 'class', 'elementor-invisible');
    $widget->add_render_attribute( 'description', 'class', 'animated-'.$widget->get_setting('description_animation_duration', ''));
    $widget->add_render_attribute( 'description', 'data-settings', json_encode([
        '_animation'      => $widget->get_setting('description_animation', ''),
        'animation_delay' => $widget->get_setting('description_animation_delay', '')
    ]));
}
?>
<div <?php kng_print_html($widget->get_render_attribute_string( 'wrap' ));?>>
    <div class="kng-row-wrap">
        <div class="kng-counter-icon">
            <?php 
            if($settings['icon_type'] === 'icon'){
                techrona_elementor_icon_render($settings, [
                    'id'         => 'counter_icon',
                    'wrap_class' => 'kng-counter-icon text-60 text-'.$widget->get_setting('icon_text_color','accent'),
                    'default_icon'    => [
                        'value'   => '',
                        'library' => 'kngi'
                    ]
                ] ); 
            } elseif($settings['icon_type'] === 'image') {
                techrona_elementor_image_render($settings, $widget, [
                    'id'          => 'icon_image',
                    'class'       => 'kng-counter-icon kng-counter-image' 
                ]);
            }
            ?>
        </div>
        <div class="kng-count-content">
            <div <?php kng_print_html($widget->get_render_attribute_string( 'counter' )); ?>>
                <span class="kng-counter-number-prefix empty-none"><?php echo esc_html($widget->get_setting('prefix','')); ?></span>
                <span <?php kng_print_html($widget->get_render_attribute_string( 'counter-number' )); ?>><?php 
                    echo esc_html($settings['starting_number']); 
                ?></span><span class="kng-counter-number-suffix empty-none"><?php echo esc_html($widget->get_setting('suffix', '')); ?></span>
            </div>
            <div <?php kng_print_html($widget->get_render_attribute_string( 'title' )); ?>><?php kng_print_html($widget->get_setting('title')); ?></div>
            <div <?php kng_print_html($widget->get_render_attribute_string( 'description' )); ?>><?php kng_print_html($widget->get_setting('description')); ?>
            </div>
        </div>
    </div>
</div>