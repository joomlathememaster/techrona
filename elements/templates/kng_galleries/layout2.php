<?php
if ( ! $settings['wp_gallery'] ) {
    return;
}
$col_xl = 12 / intval($widget->get_setting('gallery_col', 4));
$col_lg = 12 / intval($widget->get_setting('gallery_col_tablet', 3));
$col_sm = 12 / intval($widget->get_setting('gallery_col_mobile', 2));

$randGallery = $settings['wp_gallery'];
if ($settings['gallery_rand'] == 'rand'){
    shuffle($randGallery);
}
?>

<div class="kng-image-gallery clearfix" data-show="<?php echo esc_attr($widget->get_setting('gallery_show', '6'));?>" data-loadmore="<?php echo esc_attr($widget->get_setting('gallery_loadmore_show', '6'));?>">
    <div class="row kng-images-light-box" style="margin: <?php echo esc_attr($settings['gap']/-2);?>px;">
        <?php
        foreach ( $randGallery as $key => $value):
            if($key == 0)
                $item_class = "kng-gallery-item kng-overlay-wrap kng-overlay-zoom-in col-12";
            else
                $item_class = "kng-gallery-item kng-overlay-wrap kng-overlay-zoom-in col-sm-{$col_sm} col-md-{$col_lg} col-lg-{$col_xl}";
            ?>
            <div class="<?php echo esc_attr($item_class); ?>" style="padding: <?php echo esc_attr($settings['gap']/2);?>px;">
                <div class="grid-item-inner kng-radius-8 overflow-hidden relative">
                    <span class="hover-effect kng-over"><?php  
                        techrona_elementor_image_render($settings, $widget,[
                            'attachment_id' => $value['id'],
                            'size'          => 'thumbnail'
                        ]);
                    ?></span>
                    <div class="gallery-item-content">
                        <a data-elementor-lightbox-slideshow="<?php echo esc_attr($settings['element_id']);?>" class="kng-galleries-light-box kng-overlay-content d-flex align-items-center justify-content-center text-white text-hover-white p-20 text-center" href="<?php echo esc_url(wp_get_attachment_image_url($value['id'], 'full')); ?>" title="<?php echo esc_attr(wp_get_attachment_caption($value['id']))?>">
                            <div><span class="kngi-plus-circle text-60"></span>
                            <div class="kng-image-caption empty-none w-100"><?php echo wp_get_attachment_caption($value['id']);?></div></div>
                        </a>
                    </div>
                </div>
            </div>
        <?php
        endforeach;
        ?>
    </div>
    <?php if(count($randGallery) > (int)$settings['gallery_loadmore_show']): ?>
    <div class="text-center pt-40">
        <a href="#" class="kng-gallery-load btn btn-accent btn-hover-secondary btn-xl"><?php kng_print_html($widget->get_setting('load_more_text', 'Load More')); ?></a>
    </div>
    <?php endif; ?>
</div>