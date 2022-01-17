<?php
//hide default wishlist button on product archive page
add_filter( 'woosw_button_position_archive', function() {
    return '0';
} );

//hide default wishlist button on product single page
add_filter( 'woosw_button_position_single', function() {
    return '0';
} );

add_filter( 'filter_wooscp_button_archive', function() {
    return '0';
} );

add_filter( 'filter_wooscp_button_single', function() {
    return '0';
} );
 
add_filter( 'woosw_button_text', 'techrona_change_wishlist_text' );
function techrona_change_wishlist_text($text){
	$text = esc_html__( 'Wishlist','techrona' );
	return $text;
}
// add wishlist to product archive page 
if(!function_exists('techrona_woosw_loop_product')){
	add_action('techrona_shop_loop_overlay_content_top', 'techrona_woosw_loop_product', 9);
	function techrona_woosw_loop_product(){
		if(!class_exists('WPCleverWoosw')) return;
		echo do_shortcode('[woosw type="link"]');
	}
}

 

if(!function_exists('techrona_woo_wl_cp_product')){
	add_action('techrona_after_add_to_cart_button', 'techrona_woo_wl_cp_product', 10);
	function techrona_woo_wl_cp_product(){
		$product_wishlist = techrona_get_theme_opt('product_wishlist','0');
		$product_compare = techrona_get_theme_opt('product_compare','0');
		if( $product_wishlist == '1' || $product_compare == '1'){ 
			echo '<div class="kng-atc-btn-ext">';
			if($product_wishlist == '1' && class_exists('WPCleverWoosw'))
				echo do_shortcode('[woosw type="button"]');
			if($product_compare == '1' && class_exists('WPCleverWoosc'))
				echo do_shortcode( '[woosc type="button"]' );
			echo '</div>';
		}
	}
}
 


