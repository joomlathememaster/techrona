<?php
// remove page title on archive page
add_filter('woocommerce_show_page_title', function(){ return false;});
/**
 * Custom archive notices, catalog order and result count
*/
/* Loop Thumbnail Size */
add_filter( 'woocommerce_get_image_size_thumbnail', function( $size ) {
    $product_image_cropped = techrona_get_theme_opt('product_image_cropped');
    if($product_image_cropped !='1') return $size;
    return array(
        'width'  => (int)techrona_configs('techrona_product_loop_image_w'),
        'height' => (int)techrona_configs('techrona_product_loop_image_h'),
        'crop'   => 1,
    );
} ); 
 
// add custom layout for catalog order and result count
if(!function_exists('techrona_woocommerce_catalog_result')){
	// remove
	remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
	remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
	// add back
	add_action('woocommerce_before_shop_loop','techrona_woocommerce_catalog_result', 20);
	add_action('techrona_woocommerce_catalog_ordering', 'woocommerce_catalog_ordering');
	add_action('techrona_woocommerce_result_count', 'woocommerce_result_count');
	function techrona_woocommerce_catalog_result(){
		$columns = isset($_GET['col']) ? sanitize_text_field($_GET['col']) : techrona_get_theme_opt('products_columns', 4);
 		$active_col4 = $columns == '4' ? 'active' : '';
		$active_col6 = $columns == '6' ? 'active' : '';

		if(isset( $_GET['type']) && sanitize_text_field($_GET['type']) == 'list'){
			$active_col4 = $active_col6 = '';
			$active_list = 'active';
		}else{
			$active_list = '';
		}

	?>
		<div class="kng-shop-topbar-wrap row justify-content-between align-items-center gutters-30 gutters-grid">
			<div class="kng-view-layout-wrap col-12 col-sm-auto order-md-3">
				<ul class="kng-view-layout d-flex align-items-center">
					<li class="lbl"><?php echo esc_html__( 'View','techrona' ) ?></li>
					<li class="view-icon view-4 <?php echo esc_attr($active_col4) ?>"><a href="javascript:void(0);" data-cls="products columns-4" data-col="4"><span class="kngi-border-all"></span></a></li>
					<li class="view-icon view-6 <?php echo esc_attr($active_col6) ?>"><a href="javascript:void(0);" data-cls="products columns-6" data-col="6"><span class="kngi-th"></span></a></li>
					<li class="view-icon view-list <?php echo esc_attr($active_list) ?>"><a href="javascript:void(0);" data-cls="products shop-view-list" data-col="list"><span class="kngi-list-ul"></span></a></li>
				</ul>
			</div>
			<div class="col-12 col-sm-auto order-md-2">
				<?php do_action('techrona_woocommerce_catalog_ordering'); ?>
			</div>
			<div class="col text-heading number-result">
				<?php do_action('techrona_woocommerce_result_count'); ?>
			</div>
		</div>
	<?php
	}
}

/**
 * Custom products layout on archive page
 * 
*/

add_filter( 'loop_shop_columns', 'techrona_loop_shop_columns', 20 ); 
function techrona_loop_shop_columns() {
	$columns = isset($_GET['col']) ? sanitize_text_field($_GET['col']) : techrona_get_theme_opt('products_columns', 4);

	return $columns;
}

add_filter( 'woocommerce_product_loop_start', 'techrona_product_loop_start' );
function techrona_product_loop_start(){

	if(isset( $_GET['type']) && sanitize_text_field($_GET['type']) == 'list')
		return '<ul class="products shop-view-list">';
	else
		return '<ul class="products columns-'. esc_attr( wc_get_loop_prop( 'columns' ) ) .'">';
}

/**
 * Change number of products that are displayed per page (shop page)
 * $limit contains the current number of products per page based on the value stored on Options -> Reading
 * Return the number of products you wanna show per page.
 * 
 */
add_filter( 'loop_shop_per_page', 'techrona_loop_shop_per_page', 20 );
function techrona_loop_shop_per_page( $limit ) {
	$limit = techrona_get_theme_opt('product_per_page', 9);
	return $limit;
}

// add div wrap
add_action('woocommerce_before_shop_loop_item', function(){ echo '<div class="kng-shop-item-wrap kng-overlay-wrap">';}, 0);
add_action('woocommerce_after_shop_loop_item', function(){ echo '</div>';}, 9999);
// remove link on product image
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
// add link to product title
add_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_link_open', 1 );
add_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_link_close', 9999 );
// wrap product image by div
if(!function_exists('techrona_wrap_products_thumbnail_open')){
	add_action('woocommerce_before_shop_loop_item', 'techrona_wrap_products_thumbnail_open', 1);
	function techrona_wrap_products_thumbnail_open(){
		echo '<div class="kng-products-thumb relative overflow-hidden">';
	}
}
if(!function_exists('techrona_wrap_products_thumbnail_close')){
	add_action('woocommerce_before_shop_loop_item', 'techrona_wrap_products_thumbnail_close', 999);
	function techrona_wrap_products_thumbnail_close(){
		echo '</div>';
	}
}
// product thumbnail & sale flash
remove_action('woocommerce_before_shop_loop_item_title','woocommerce_show_product_loop_sale_flash', 10);
add_action('woocommerce_before_shop_loop_item','woocommerce_show_product_loop_sale_flash', 9);
remove_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail', 10);

add_action('woocommerce_before_shop_loop_item','woocommerce_template_loop_product_thumbnail', 10);
// add products overlay content
if(!function_exists('techrona_shop_loop_overlay_content')){
	add_action('woocommerce_before_shop_loop_item', 'techrona_shop_loop_overlay_content', 10);
	function techrona_shop_loop_overlay_content(){
	?>
		<div class="kng-overlay-content kng-overlay-center-to-side d-flex justify-content-center">
			<div class="kng-overlay-content-inner justify-content-center">
				<div class="kng-overlay-content-top empty-none align-self-start"><?php do_action('techrona_shop_loop_overlay_content_top'); ?></div>
				<div class="kng-overlay-content-middle kng-icon-list empty-none align-self-center"><?php do_action('techrona_shop_loop_overlay_content_midde'); ?></div>
				<div class="kng-overlay-content-end empty-none align-self-end"><?php do_action('techrona_shop_loop_overlay_content_end'); ?></div>
			</div>
		</div>
	<?php
	}
}
// Add product content after product thumb
if(!function_exists('techrona_shop_loop_after_product_thumbnail')){
	add_action('woocommerce_before_shop_loop_item', 'techrona_shop_loop_after_product_thumbnail', 998);
	function techrona_shop_loop_after_product_thumbnail(){
	?>
		<div class="kng-after-product-thumb">
			<?php do_action('techrona_shop_loop_after_product_thumbnail'); ?>
		</div>
	<?php
	}
}


// Loop default add to cart button
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
add_action('techrona_shop_loop_after_product_thumbnail', 'woocommerce_template_loop_add_to_cart');
add_action('techrona_add_to_cart_in_list_view', 'woocommerce_template_loop_add_to_cart');
add_action('techrona_shop_loop_after_product_thumbnail', 'techrona_woocommerce_template_loop_added_to_cart');
if(!function_exists('techrona_woocommerce_template_loop_added_to_cart')){
	function techrona_woocommerce_template_loop_added_to_cart(){
		?>
			<a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="added_to_cart btn btn-xl" title="<?php esc_attr_e('View Cart','techrona');?>">
				<span class="kng-btn-content">
					<span class="kng-btn-text"><?php esc_html_e('View Cart','techrona');?></span>
					<span class="kng-btn-icon"><span class="kngi-arrow-right"></span></span>
				</span>
			</a>
		<?php
	}
}

add_filter('woocommerce_loop_add_to_cart_link', 'techrona_woocommerce_loop_add_to_cart_link', 10, 3);
function techrona_woocommerce_loop_add_to_cart_link($button, $product, $args){
	return sprintf(
		'<a href="%s" data-quantity="%s" class="%s" %s><span class="kng-btn-content"><span class="kng-btn-text">%s</span>%s</span></a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
		esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
		isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
		esc_html( $product->add_to_cart_text() ),
		'<span class="kng-btn-icon kng-addtocart-icon kngi-shopping-basket"></span>'
	);
}

if(!function_exists('techrona_woocommerce_loop_add_to_cart_args')){
	add_filter('woocommerce_loop_add_to_cart_args', 'techrona_woocommerce_loop_add_to_cart_args');
	function techrona_woocommerce_loop_add_to_cart_args($args){
		global $product;
		$args['class'] = implode(
			' ',
			array_filter(
				array(
					'button btn',
					'product_type_' . $product->get_type(),
					$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
					$product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
				)
			)
		);
		return $args;
	}
}


// Wrap products infor by div 
if(!function_exists('techrona_loop_product_content_open')){
	add_action('woocommerce_before_shop_loop_item', 'techrona_loop_product_content_open', 1000);
	function techrona_loop_product_content_open(){
		echo '<div class="kng-products-content"><div class="kng-products-content-wrap">';
	}
}
if(!function_exists('techrona_loop_product_content_inner_open')){
	add_action('woocommerce_before_shop_loop_item', 'techrona_loop_product_content_inner_open', 1001);
	function techrona_loop_product_content_inner_open(){
		echo '<div class="kng-products-content-inner">';
	}
}
if(!function_exists('techrona_loop_product_content_inner_close')){
	add_action('woocommerce_after_shop_loop_item', 'techrona_loop_product_content_inner_close', 900);
	function techrona_loop_product_content_inner_close(){
		echo '</div>';
	}
}
if(!function_exists('techrona_loop_product_content_close')){
	add_action('woocommerce_after_shop_loop_item', 'techrona_loop_product_content_close', 999);
	function techrona_loop_product_content_close(){
		echo '</div></div>';
	}
}
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
if(!function_exists('techrona_loop_item_title_rating')){
	add_action('woocommerce_before_shop_loop_item_title', 'techrona_loop_item_title_rating', 11);
	function techrona_loop_item_title_rating(){
		global $product;
		if ( ! wc_review_ratings_enabled() ) {
			return;
		}
		$review_count = number_format_i18n($product->get_review_count());
		echo '<div class="kng-rating-wrap">';
			echo wc_get_rating_html( $product->get_average_rating() );
			if($review_count >0 ){
				printf(
	                _nx(
	                    '<span class="review-num">(%1$s Review)</span>',
	                    '<span class="review-num">(%1$s Reviews)</span>',
	                    $review_count,
	                    'review title',
	                    'techrona'
	                ),
	                $review_count
	            );
			}

			if ( $price_html = $product->get_price_html() )
				echo '<span class="price">'. $price_html .'</span>'; 
		echo '</div>';
	}
}
if(!function_exists('techrona_loop_item_title_category')){
	add_action('woocommerce_after_shop_loop_item_title', 'techrona_loop_item_title_category', 5);
	function techrona_loop_item_title_category(){
		global $product;
		echo '<div class="kng-loop-product-cat">';
		the_terms($product->get_id(), 'product_cat', '', ', ', '' );
		echo '</div>';
            
	}
}

// Loop product title 
if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ) {

	/**
	 * Show the product title in the product loop. By default this is an H2.
	 */
	function woocommerce_template_loop_product_title() {
		echo '<span class="kng-product-title">' . get_the_title() . '</span>';
	}
}

// paginate links
add_filter('woocommerce_pagination_args', 'techrona_woocommerce_pagination_args');
function techrona_woocommerce_pagination_args($default){
	$default = array_merge($default, [
		'prev_text' => '<span class="kngi-angle-left"></span>',
		'next_text' => '<span class="kngi-angle-right"></span>',
		'type'      => 'plain',
	]);
	return $default;
}

if(!function_exists('techrona_loop_item_title_category_rating_list_view')){
	add_action('woocommerce_after_shop_loop_item_title', 'techrona_loop_item_title_category_rating_list_view', 15);
	function techrona_loop_item_title_category_rating_list_view(){
		global $product; 
		echo '<div class="kng-loop-product-cat-rating">';
		echo '<div class="kng-loop-product-category">';
		the_terms($product->get_id(), 'product_cat', '', ', ', '' );
		echo '</div>';
		if ( wc_review_ratings_enabled() ) {
			$review_count = number_format_i18n($product->get_review_count());
			echo '<div class="kng-rating-wraps">';
				echo wc_get_rating_html( $product->get_average_rating() );
				if($review_count >0 ){
					printf(
		                _nx(
		                    '<span class="review-num">(%1$s Review)</span>',
		                    '<span class="review-num">(%1$s Reviews)</span>',
		                    $review_count,
		                    'review title',
		                    'techrona'
		                ),
		                $review_count
		            );
				}
			echo '</div>';
		}
        echo '</div>';    
	}
}
if(!function_exists('techrona_after_shop_loop_item_title_excerpt_list_view')){
	add_action('woocommerce_after_shop_loop_item_title', 'techrona_after_shop_loop_item_title_excerpt_list_view', 16);
	function techrona_after_shop_loop_item_title_excerpt_list_view(){
		global $product; 
		global $post;
		$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );
		echo '<div class="kng-loop-product-excerpt">';
			echo ''.$short_description;
        echo '</div>';    
	}
}

if(!function_exists('techrona_after_shop_loop_item_title_product_attributes_list_view')){
	add_action('woocommerce_after_shop_loop_item_title', 'techrona_after_shop_loop_item_title_product_attributes_list_view', 18);
	function techrona_after_shop_loop_item_title_product_attributes_list_view(){
		global $product; 
		$product_attributes = array();
		$attributes = array_filter( $product->get_attributes(), 'wc_attributes_array_filter_visible' );
		foreach ( $attributes as $attribute ) {
			$values = array();

			if ( $attribute->is_taxonomy() ) {
				$attribute_taxonomy = $attribute->get_taxonomy_object();
				$attribute_values   = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'all' ) );

				foreach ( $attribute_values as $attribute_value ) {
					$value_name = esc_html( $attribute_value->name );

					if ( $attribute_taxonomy->attribute_public ) {
						$values[] = '<a href="' . esc_url( get_term_link( $attribute_value->term_id, $attribute->get_name() ) ) . '" rel="tag">' . $value_name . '</a>';
					} else {
						$values[] = $value_name;
					}
				}
			} else {
				$values = $attribute->get_options();

				foreach ( $values as &$value ) {
					$value = make_clickable( esc_html( $value ) );
				}
			}

			$product_attributes[ 'attribute_' . sanitize_title_with_dashes( $attribute->get_name() ) ] = array(
				'label' => wc_attribute_label( $attribute->get_name() ),
				'value' => apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values ),
			);
		} 

		 
		$author_name = '';
		$author_slug = get_post_meta( get_the_ID(), 'product_author', true );
		if(!empty($author_slug)){
			$author_id = techrona_get_id_by_slug($author_slug,'authors');
			$author = get_post($author_id);
			$author_name = techrona_html($author->post_title);
		}
		echo '<ul class="kng-loop-product-attribute">';
			if(!empty($author_name)){
				echo '<li class="attribute-item author-name">';
					echo '<span class="lbl">'. esc_html__('Author:','techrona').'</span>';
					echo '<span class="value">'. esc_html( $author_name ).'</span>';
				echo '</li>';
			}
			if ( !empty( $product_attributes )){
				foreach ( $product_attributes as $product_attribute_key => $product_attribute ){
					if( $product_attribute_key == 'attribute_pa_format' || $product_attribute_key == 'attribute_pa_publisher'){
						if($product_attribute_key == 'attribute_pa_format') $product_attribute['label'] = esc_html__('Cover Type','techrona');
						echo '<li class="attribute-item '. esc_attr( $product_attribute_key ).'">';
							echo '<span class="lbl">'. wp_kses_post( $product_attribute['label'] ).':</span>';
							echo '<span class="value">'. wp_kses_post( $product_attribute['value'] ).'</span>';
						echo '</li>';
					}
				}
			}
        echo '</ul>';    
	}
}

if(!function_exists('techrona_loop_product_content_btns_content')){
	add_action('woocommerce_after_shop_loop_item', 'techrona_loop_product_content_btns_content', 901);
	function techrona_loop_product_content_btns_content(){
		global $product; 
		echo '<div class="kng-products-content-list-view">';
			if ( $price_html = $product->get_price_html() )
				echo '<span class="price">'. $price_html .'</span>';
			do_action( 'techrona_add_to_cart_in_list_view' );
			techrona_woo_wl_cp_product();
		echo '</div>';
	}
}
 