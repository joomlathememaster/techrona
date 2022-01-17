<?php
/**
 * The main template file
 *
 */
get_header();
$product_layout = isset($_GET['product_layout']) ? sanitize_text_field($_GET['product_layout']) :techrona_get_theme_opt('product_layout','default');
if(is_singular('product')){
	$content_col = 'product_single_content_col';
	$sidebar_pos = 'product_single_sidebar_pos';
    $cls_affix   = 'woo-single'.' layout-'.$product_layout;
} else {
	$content_col = 'product_page_content_col';
	$sidebar_pos = 'product_page_sidebar_pos';
    $cls_affix   = 'woo-page';
}

?>
<?php if(is_singular( 'product' ) && $product_layout == '1'): 
    remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_price',10 );
    ?>
    <div class="container kng-content-container">
        <div class="row kng-content-row kng-content-<?php echo esc_attr($cls_affix)?>">
            <div id="kng-content-area" class="<?php techrona_content_css_class(['content_col'=> $content_col,'sidebar_pos' => $sidebar_pos]); ?>">
                <?php woocommerce_content(); ?>
            </div>
            <?php techrona_sidebar(['content_col'=> $content_col,'sidebar_pos' => $sidebar_pos, 'class' => 'kng-sidebar-shop single']); ?>
        </div>
    </div>
<?php else: ?>
    <div class="container kng-content-container">
        <div class="row kng-content-row kng-content-<?php echo esc_attr($cls_affix)?>">
            <div id="kng-content-area" class="<?php techrona_content_css_class(['content_col'=> $content_col,'sidebar_pos' => $sidebar_pos]); ?>"><?php 
            	woocommerce_content(); 
            ?></div>
            <?php techrona_sidebar(['content_col'=> $content_col,'sidebar_pos' => $sidebar_pos, 'class' => 'kng-sidebar-shop']); ?>
        </div>
    </div>
<?php endif; ?>
<?php
get_footer('shop');
