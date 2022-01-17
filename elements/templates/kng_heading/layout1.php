<?php
$default_settings = [
    'title' => '',
    'title_tag' => 'h3',
    'sub_title' => '',
    'sub_title_style' => '',
    'text_align' => '',
    'kng_icon' => '',
];
$settings = array_merge($default_settings, $settings);

$kng_align = techrona_get_class_breakpoints($settings, [
    'prefix' => 'text_align',
    'type-prefix' => 'text-',
]);

$widget->add_render_attribute( 'wrap-heading', 'class', 'kng-heading-wrap '.trim(implode(' ', $kng_align)));
 
$widget->add_render_attribute( 'large-heading', 'class', 'item-title');
if ( $settings['heading_animate'] ) {
    $widget->add_render_attribute( 'large-heading', 'class', 'kng-animate kng-invisible');
    $widget->add_render_attribute( 'large-heading', 'data-settings', 
        json_encode([
            'animation'      => $settings['heading_animate'],
            'animation_delay' => $settings['heading_animation_delay']
        ])
    );
}
$widget->add_render_attribute( 'sub-heading', 'class', 'item-sub-title '.$settings['sub_title_style']);
if ( $settings['sub_heading_animate'] ) {
    $widget->add_render_attribute( 'sub-heading', 'class', 'kng-animate kng-invisible');
    $widget->add_render_attribute( 'sub-heading', 'data-settings', 
        json_encode([
            'animation'      => $settings['sub_heading_animate'],
            'animation_delay' => $settings['sub_heading_animation_delay']
        ])
    );
}
 
extract($settings); 
  
$sub_title_ontop = $widget->get_settings( 'sub_title_ontop' );
 
?>
<div <?php kng_print_html($widget->get_render_attribute_string( 'wrap-heading' )); ?>>
    <?php if($sub_title_ontop && !empty($sub_title)): ?>
        <div <?php kng_print_html($widget->get_render_attribute_string( 'sub-heading' )); ?>>
            <span><?php echo kng_print_html(nl2br($sub_title)); ?></span>
        </div>
    <?php endif; ?>
    <<?php echo esc_attr($title_tag); ?> <?php kng_print_html($widget->get_render_attribute_string( 'large-heading' )); ?>>
        <?php
            echo '<span>';
            echo wp_kses_post(nl2br($title));
            echo '</span>';
        ?>
    </<?php echo esc_attr($title_tag); ?>>
    <?php if(!empty($sub_title) && empty($sub_title_ontop)) : ?>
        <div <?php kng_print_html($widget->get_render_attribute_string( 'sub-heading' )); ?>">
            <span><?php echo kng_print_html(nl2br($sub_title)); ?></span>
        </div>
    <?php endif; ?>
</div>

