<?php
if ( ! $settings['wp_gallery'] ) {
    return;
}
 
$col_xxl = 12 / intval($widget->get_setting('gallery_col', 4));
$col_xl = 12 / intval($widget->get_setting('gallery_col_laptop', 4));
$col_lg = 12 / intval($widget->get_setting('gallery_col_tablet_extra', 3));
$col_md = 12 / intval($widget->get_setting('gallery_col_tablet', 2));
$col_sm = 12 / intval($widget->get_setting('gallery_col_mobile_extra', 2));
$col_xs = 12 / intval($widget->get_setting('gallery_col_mobile', 2));

$randGallery = $settings['wp_gallery'];
if ($settings['gallery_rand'] == 'rand'){
    shuffle($randGallery);
}
?>

<div class="kng-image-gallery clearfix layout-<?php echo esc_attr($settings['layout'])?>" data-show="<?php echo esc_attr($widget->get_setting('gallery_show', '12'));?>" data-loadmore="<?php echo esc_attr($widget->get_setting('gallery_loadmore_show', '12'));?>">
    <div class="row kng-images-light-box" style="margin: <?php echo esc_attr($settings['gap']/-2);?>px;">
        <?php
        foreach ( $randGallery as $key => $value):
            $post_id = (int) $value['id'];
            $post    = get_post( $post_id );

            $item_class = "kng-gallery-item kng-overlay-wrap kng-overlay-zoom-in col-xs-{$col_xs} col-sm-{$col_sm} col-md-{$col_md} col-lg-{$col_lg} col-xl-{$col_xl} col-xxl-{$col_xxl}";
            ?>
            <div class="<?php echo esc_attr($item_class); ?>" style="padding: <?php echo esc_attr($settings['gap']/2);?>px;">
                <div class="grid-item-inner overflow-hidden relative">
                    <span class="hover-effect kng-over"><?php
                        techrona_elementor_image_render($settings, $widget,[
                            'id'            => $value['id'],
                            'attachment_id' => $value['id'],
                            'size'          => 'thumbnail'
                        ]);
                    ?></span>
                    <div class="gallery-item-content">
                        <a data-elementor-lightbox-slideshow="<?php echo esc_attr($settings['element_id']);?>" class="kng-galleries-light-box kng-overlay-content d-flex align-items-center justify-content-center text-white text-hover-white p-20 text-center" href="<?php echo esc_url(wp_get_attachment_image_url($value['id'], 'full')); ?>" title="<?php echo esc_attr(wp_get_attachment_caption($value['id']))?>">
                            <span class="kngi-plus"></span>
                        </a>
                    </div>
                </div>
                <div class="kng-gal-content image-caption">
                    <h4 class="kng-image-caption empty-none w-100"><?php kng_print_html($post->post_excerpt);?></h4>
                    <div class="kng-image-desc empty-none w-100"><?php kng_print_html($post->post_content);?></div>
                </div>
            </div>
        <?php
        endforeach;
        ?>
    </div>
    <?php if(count($randGallery) > (int)$settings['gallery_loadmore_show']): ?>
    <div class="text-center load-more-wrap">
        <a href="#" class="kng-gallery-load btn btn-primary btn-hover-secondary"><?php kng_print_html($widget->get_setting('load_more_text', 'Load More')); ?><span class="kng-btn-icon kngi-arrow-right-solid"></span></a>
    </div>
    <?php endif; ?>
</div>