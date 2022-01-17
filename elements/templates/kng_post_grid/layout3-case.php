<?php
$html_id = kng_get_element_id($settings);
$tax     = array();
$source  = $widget->get_setting('source_'.$settings['post_type'], '');
$orderby = $widget->get_setting('orderby', 'date');
$order   = $widget->get_setting('order', 'desc');
$limit   = $widget->get_setting('limit', 6);
extract(kng_get_posts_of_grid($settings['post_type'], [
    'source'   => $source,
    'orderby'  => $orderby,
    'order'    => $order,
    'limit'    => $limit,
    //'post_ids' => [],
]));
// Fiilter 
$filter_default_title = $widget->get_setting('filter_default_title', 'All');
$filter                     = $widget->get_setting('filter', 'false');
$filter_alignment           = $widget->get_setting('filter_alignment', 'center');
// pagination
$pagination_type            = $widget->get_setting('pagination_type', 'false');
$pagination_align_cls      = 'justify-content-'.$widget->get_setting('pagination_align', 'center');

$layout = $settings['layout_'.$settings['post_type']];
 
$load_more = array(
    'post_type'                  => $settings['post_type'],   
    'layout'                     => $layout,
    'startPage'                  => $paged,
    'maxPages'                   => $max,
    'total'                      => $total,
    'perpage'                    => $limit, 
    'nextLink'                   => $next_link,
    'source'                     => $source,
    'orderby'                    => $orderby,
    'order'                      => $order,
    'limit'                      => $limit,
    //'post_ids'                   => $post_ids, 
    'pagination_type'            => $pagination_type,
    // Element settings
    'masonry_mode'               => $widget->get_setting('masonry_mode', 'fitRows'),
    'col_xxl'                     => $widget->get_setting('col_xxl', '5'),
    'col_xl'                     => $widget->get_setting('col_xl', '4'),
    'col_lg'                     => $widget->get_setting('col_lg', '3'),
    'col_md'                     => $widget->get_setting('col_md', '2'),
    'col_sm'                     => $widget->get_setting('col_sm', '1'),
    'gap'                        => $widget->get_setting('gap', '30'),
    'gap_extra'                  => $widget->get_setting('gap_extra', ''),   
    'thumbnail_size'             => $widget->get_setting('thumbnail_size', 'medium'),
    'thumbnail_size_custom'      => $widget->get_setting('thumbnail_size_custom', ''),
    // excerpt
    'excerpt_lenght'             => $widget->get_setting('excerpt_lenght', 0),
    'excerpt_more_text'          => $widget->get_setting('excerpt_more_text', ''),
    // Read more
    'show_readmore'              => $widget->get_setting('show_readmore', 'yes'),
    'readmore_text'              => $widget->get_setting('readmore_text', ''),
    // Socical
    'show_fb'                    => $widget->get_setting('show_fb', ''),     
    'show_tw'                    => $widget->get_setting('show_tw', ''),     
    'show_insta'                 => $widget->get_setting('show_insta', ''),     
    'show_email'                 => $widget->get_setting('show_email', ''),     
    'show_phone'                 => $widget->get_setting('show_phone', ''),
    'grid'                       => true,
    'pagin_align_cls'            => $pagination_align_cls,
    'grid_custom_columns'        => $widget->get_setting('grid_custom_columns'),
);
// Render Attribute
// Grid
$masonry_mode = $widget->get_setting('masonry_mode', 'fitRows');
if(is_admin())
    $grid_class = 'kng-grid-inner kng-grid-masonry-adm row relative animation-time';
else
    $grid_class = 'kng-grid-inner kng-grid-masonry row relative animation-time';
 
$widget->add_render_attribute( 'grid', 'class', $grid_class);
$widget->add_render_attribute( 'grid', 'data-layout', $masonry_mode);
// css style
if( !empty($settings['gap']) )
    $widget->add_render_attribute( 'grid', 'style', 'margin:'.($settings['gap']/-2).'px');
 
 
?>

<div <?php techrona_elementor_masonry_settings_render_attrs($widget, $settings,['class' => 'kng-post-grid layout-'.$layout]);?>>
    <?php if ($filter == "true"): ?>
        <div class="kng-grid-filter-wrap row justify-content-<?php echo esc_attr($filter_alignment); ?>">
            <span class="kng-filter-item active col-auto" data-filter="*"><?php echo esc_html($filter_default_title); ?></span>
            <?php foreach ($categories as $category): ?>
                <?php 
                    $category_arr = explode('|', $category); 
                    $tax[]        = $category_arr[1];
                    $term         = get_term_by('slug',$category_arr[0], $category_arr[1]); 
                ?>
                <span class="kng-filter-item col-auto" data-filter="<?php echo esc_attr('.' . $term->slug); ?>">
                    <?php echo esc_html($term->name); ?>
                </span>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <div <?php kng_print_html($widget->get_render_attribute_string('grid')); ?>>
        <?php 
            $load_more['tax'] = $tax;  
            techrona_get_post_grid($posts, $load_more);
        ?>
        <div class="kng-grid-overlay"></div>
    </div>
    <?php if ($pagination_type == 'pagination') { ?>
        <div class="kng-post-pagination kng-grid-pagination d-flex" data-loadmore="<?php echo esc_attr(json_encode($load_more)); ?>" data-query="<?php echo esc_attr(json_encode($args)); ?>">
            <?php techrona_posts_pagination($query, true, ['class' => $pagination_align_cls]); ?>
        </div>
    <?php } ?>
    <?php if (!empty($next_link) && $pagination_type == 'loadmore') { ?>
        <div class="kng-post-pagination kng-load-more text-center <?php echo esc_attr($pagination_align_cls) ?>" data-loadmore="<?php echo esc_attr(json_encode($load_more)); ?>" data-loading-text="Loading">
            <span class="btn btn-lg btn-fill btn-accent">
                <span class="kng-btn-content">
                    <span class="kng-btn-text"><?php echo esc_html($settings['loadmore_text']); ?></span>
                </span>
            </span>
        </div>
    <?php } ?>
</div>