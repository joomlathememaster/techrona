<?php
    $html_id   = kng_get_element_id($settings);
    $tax       = array();
    $source    = $widget->get_setting('source_'.$settings['post_type']);
    $orderby   = $widget->get_setting('orderby');
    $order     = $widget->get_setting('order');
    $limit     = $widget->get_setting('limit');
    $settings['layout']    = $settings['layout_'.$settings['post_type']];

    extract(kng_get_posts_of_grid($settings['post_type'], [
        'source'   => $source,
        'orderby'  => $orderby,
        'order'    => $order,
        'limit'    => $limit,
    ]));
     
 
?>
  
<div class="kng-swiper-sliders <?php echo esc_attr('kng-post-grid layout-'.$settings['layout'])?>">
    <div class="kng-swiper-slider-wrap">
        <div <?php techrona_swiper_slider_settings($widget); ?>>
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