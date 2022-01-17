<?php 
$default_settings = [
    'layout'    => '3',
    'search_type' => '1',
    'placeholder' => '',
];

$content_aligns = techrona_get_class_breakpoints($settings, [
    'prefix' => 'content_align',
    'type-prefix' => 'justify-content-',
]);

$settings = array_merge($default_settings, $settings);
extract($settings); 

?>
<?php if($search_type == '1'): ?>
    <div class="kng-search-wrap search-normal layout-<?php echo esc_attr($layout) ?> <?php echo esc_attr(implode(' ', $content_aligns)) ?>">
        <form role="search" method="get" class="kng-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <input type="search" class="kng-search-field" placeholder="<?php echo esc_attr( $settings['placeholder']); ?>" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off"/>
            <button type="submit" class="kng-search-submit" value=""><span class="kngi-search-400"></span></button>
        </form>
    </div>
<?php endif; ?>
<?php if($search_type == '2'): ?>
    <div class="kng-search-wrap search-ajax layout-<?php echo esc_attr($layout) ?> <?php echo esc_attr(implode(' ', $content_aligns)) ?>">
        <div class="kng-ajax-search">
            <form role="search" method="get" class="kng-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <fieldset>
                    <div class="search-button-group">
                        <a href="#" class="search-clear remove" title="Clear"></a>
                        <span class="search-icon"><span class="kngi-search-400"></span></span>
                        <input type="search" class="kng-search-field" placeholder="<?php echo esc_attr( $settings['placeholder']); ?>" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off"/>
                        <button type="submit" class="kng-search-submit" value="<?php echo esc_attr__( 'Search', 'techrona' ); ?>"><?php techrona_get_svg('icon-search') ?></button>
                    </div>
                    <input type="hidden" name="post_type" value="product">
                    <div class="autocomplete-wrapper"><ul class="product_list_result row" style="display: none;"></ul></div>
                </fieldset>
            </form>
        </div>
    </div>
<?php endif; ?>

 