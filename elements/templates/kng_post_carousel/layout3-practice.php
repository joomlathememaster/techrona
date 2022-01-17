<?php
$html_id = kng_get_element_id($settings);
$tax     = array();
$source  = $widget->get_setting('source_'.$settings['post_type'], '');
$orderby = $widget->get_setting('orderby', 'date');
$order   = $widget->get_setting('order', 'desc');
$limit   = $widget->get_setting('limit', 6);
$settings['layout']    = $settings['layout_'.$settings['post_type']];
extract(kng_get_posts_of_grid($settings['post_type'], [
    'source'   => $source,
    'orderby'  => $orderby,
    'order'    => $order,
    'limit'    => $limit,
    //'post_ids' => [],
]));
$args = [
    'slide_to_show_widescreen'   => $widget->get_setting('slide_to_show_widescreen', ''),
    'slide_to_show'              => $widget->get_setting('slide_to_show', '3'),
    'slide_to_show_laptop'       => $widget->get_setting('slide_to_show_laptop', '3'),
    'slide_to_show_tablet_extra' => $widget->get_setting('slide_to_show_tablet_extra', '3'),
    'slide_to_show_tablet'       => $widget->get_setting('slide_to_show_tablet', '3'),
    'slide_to_show_mobile_extra' => $widget->get_setting('slide_to_show_mobile_extra', '2'),
    'slide_to_show_mobile'       => $widget->get_setting('slide_to_show_mobile', '1'),
];

$args['slide_to_show_widescreen'] = empty($args['slide_to_show_widescreen']) ? $args['slide_to_show'] : $args['slide_to_show_widescreen'];

?>
<div class="kng-swiper-sliders <?php echo esc_attr('kng-post-grid layout-'.$settings['layout'])?>">
    <div class="kng-swiper-slider-wrap">
        <div <?php techrona_swiper_slider_settings($widget,$args); ?>>
            <?php techrona_swiper_slider_arrows_top($settings); ?>
            <div class="kng-swiper-wrapper swiper-wrapper">
                <?php
                    $settings['tax'] = $tax;
                    techrona_get_post_grid($posts, $settings, [
                        'item_class' => 'kng-swiper-slide swiper-slide'
                    ]); 
                ?>
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